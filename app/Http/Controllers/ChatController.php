<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Book;
use App\Models\Genre;

class ChatController
{
    public function chat(Request $request)
    {
        $user = Auth::user();
        $userMessage = strtolower($request->input('message'));

        $genreFilter = null;
        $priceFilter = null;

        // 🧐 LoafBot tries to detect any genres mentioned
        $genres = Genre::pluck('name')->map(fn($g) => strtolower($g))->toArray();
        foreach ($genres as $genre) {
            if (str_contains($userMessage, $genre)) {
                $genreFilter = $genre;
                break;
            }
        }

        // 💰 Check if the user mentions a budget like "under $20"
        if (preg_match('/under\s*\$?(\d+)/', $userMessage, $matches)) {
            $priceFilter = floatval($matches[1]);
        }

        // 📦 LoafBot checks your liked, carted, and purchased books
        $likedBooks = $user->likes()->with('book.genres')->get()->pluck('book');
        $cartBooks = $user->cart ? $user->cart->items()->with('book.genres')->get()->pluck('book') : collect();
        $purchasedBooks = $user->orders()
            ->with(['orderItems.book.genres'])
            ->get()
            ->flatMap(fn($order) => $order->orderItems->pluck('book'))
            ->unique('id');

        // 📚 A helper to nicely format books for LoafBot's response
        $formatBooks = fn($books) => $books->map(
            fn($b) =>
            "📖 Title: {$b->title}\n👤 Author: {$b->author}\n🏷️ Genre: " .
                $b->genres->pluck('name')->implode(', ') .
                "\n📝 Description: {$b->description}"
        )->implode("\n\n");

        $likesContext = $formatBooks($likedBooks);
        $cartContext = $formatBooks($cartBooks);
        $purchasedContext = $formatBooks($purchasedBooks);

        // 🧠 What genres does the user seem to love?
        $preferredGenres = $likedBooks
            ->flatMap(fn($b) => $b->genres)
            ->pluck('id')
            ->unique();

        // 🔍 Let’s search for books based on user's taste or filters
        $availableBooks = Book::with('genres')
            ->whereNotIn('id', $purchasedBooks->pluck('id'))
            ->when($genreFilter, function ($query) use ($genreFilter) {
                return $query->whereHas('genres', function ($q) use ($genreFilter) {
                    $q->whereRaw('LOWER(name) LIKE ?', ["%$genreFilter%"]);
                });
            })
            ->when($priceFilter, fn($q) => $q->where('price', '<=', $priceFilter))
            ->when(!$genreFilter && $preferredGenres->isNotEmpty(), function ($query) use ($preferredGenres) {
                return $query->whereHas('genres', fn($q) => $q->whereIn('genres.id', $preferredGenres));
            })
            ->limit(50)
            ->get();

        $availableContext = $formatBooks($availableBooks);

        // 🧵 Maintain a simple 4-line history for context
        $sessionHistory = session('chat_history', []);
        $sessionHistory[] = "User: $userMessage";
        $sessionHistory = array_slice($sessionHistory, -4); // Keep only last 4
        $chatHistory = implode("\n", $sessionHistory);

        // 🤖 Here’s LoafBot’s full prompt
        $prompt = <<<EOT
                    You are LoafBot, a friendly and helpful virtual book sales assistant. Speak warmly and concisely, like you're chatting in a cozy bookstore. Your tone is casual and cheerful — like a friendly bookstore buddy. Use emojis occasionally (📚, 😊) to add charm.

                    Your job:
                    - Recommend books or answer book-related questions clearly.
                    - Only use the provided data: liked books, cart, purchased books, and **Available Books**.
                    - Never invent or suggest book titles not in the "Available Books" list.
                    - Never mention books that are unavailable or out of stock.
                    - Never make assumptions about the user’s mood, intentions, or preferences unless explicitly stated.

                    Response rules:
                    - Keep it short: ideally under 3 sentences.
                    - Do not restate prior context (e.g., “Since your last message…”).
                    - Do not list liked or purchased books unless the user directly asks.
                    - If the user’s message is unrelated to books (e.g., jokes, weather, random questions), politely redirect and explain that you specialize in helping people discover great reads.
                    - If you don’t have relevant books to suggest, offer to explore new arrivals, top-rated books, or hidden gems instead.

                    Stay on-topic, be helpful, and make the experience feel personal and enjoyable. 

                    Here’s what I know so far:

                    Books You've Liked:
                    $likesContext

                    Books in Your Cart:
                    $cartContext

                    Books You've Purchased:
                    $purchasedContext

                    Available Books (only suggest from this list):
                    $availableContext


                    Recent Chat:
                    $chatHistory

                    User: $userMessage  
                    LoafBot:
                    EOT;


        // 💬 Send the prompt to the local LLM and wait for a reply
        session(['chat_history' => [...$sessionHistory, "LoafBot: (thinking...)"]]);

        $response = Http::post('http://localhost:11434/api/generate', [
            'model' => 'llama3',
            'prompt' => $prompt,
            'stream' => false,
        ]);

        $responseText = $response->successful() ? $response->json()['response'] ?? null : null;

        // 😅 Fallback if LoafBot is unsure what to say
        $reply = trim($responseText ?? '') ?: "Oops! I couldn't find any good reads for that. Want to explore some bestsellers or cozy picks instead? 📚";

        // 📝 Update conversation history
        $sessionHistory[] = "LoafBot: $reply";
        session(['chat_history' => $sessionHistory]);

        return response()->json([
            'reply' => $reply,
        ]);
    }
}
