<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Book;
use App\Models\Genre;
use App\Services\EmbeddingService;
use App\Services\QdrantService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        $formatBooks = fn($books) => $books->take(3)->map(
            fn($b) =>
            "- *{$b->title}* – " .
                Str::of($b->description)->words(300, '...') .
                 " (RM " . number_format($b->price, 2) . ", In stock: {$b->stock})"
        )->implode("\n");


        $likesContext = $formatBooks($likedBooks);
        $cartContext = $formatBooks($cartBooks);
        $purchasedContext = $formatBooks($purchasedBooks);


        // 🔍 Let’s search for books based on user's taste or filters using qdrant embeded vector
        $embedding = app(EmbeddingService::class)->getEmbedding($userMessage);

        $matchedIds = [];

        if ($embedding && count($embedding) === 768) {
            $qdrantResults = app(QdrantService::class)->search('books', $embedding, 10);
            $matchedIds = collect($qdrantResults['result'] ?? [])->pluck('id')->toArray();
        }


        $availableBooks = Book::with('genres')
            ->when(!empty($matchedIds), fn($q) => $q->whereIn('id', $matchedIds), fn($q) => $q->limit(50))
            ->whereNotIn('id', $purchasedBooks->pluck('id'))
            ->where('stock', '>', 0) // ✅ Only show books in stock
            ->when($genreFilter, fn($q) => $q->whereHas('genres', fn($q) => $q->whereRaw('LOWER(name) LIKE ?', ["%$genreFilter%"])))
            ->when($priceFilter, fn($q) => $q->where('price', '<=', $priceFilter))
            ->get();


        $availableContext = $formatBooks($availableBooks);

        // 🧵 Maintain a simple 4-line history for context
        $sessionHistory = session('chat_history', []);
        $sessionHistory[] = "User: $userMessage";
        $sessionHistory = array_slice($sessionHistory, -4); // Keep only last 4
        $chatHistory = implode("\n", $sessionHistory);

        $trimmedAvailableBooks = $availableBooks->take(5); // Only take top 5 
        $availableContext = $formatBooks($trimmedAvailableBooks);

        /*         $recommendationNote = $availableBooks->count() > 5
            ? "I’ve picked a few you might like — want more options? 😊"
            : ""; */

        // 🤖 Here’s LoafBot’s full prompt
        $prompt = <<<EOT
                You are LoafBot, a friendly and concise virtual book assistant in a cozy bookstore. Your job is to help users find books based only on what’s available and what they’ve liked, carted, or purchased.

                🧠 Behavior Rules:
                - Respond warmly, like a friendly bookstore buddy.
                - Avoid repeating greetings like “Hello” more than once.
                - Keep each response to under 3 short sentences.
                - NEVER repeat book titles or prices more than once.
                - Use emojis occasionally (📚, 😊, 💖) to add charm — but don’t overdo it.

                📦 Source Rules:
                - ONLY mention books from the provided "Available Books" list.
                - NEVER invent or guess book titles.
                - If user asks about a book, respond with what it’s about — but never suggest unrelated books unless requested.
                - If no books match, offer to explore genres, themes, or recent arrivals.

                📘 Book Format:
                When you mention a book, follow this format (only once):
                *Title* – RM 39.90 (Stock: 12)

                🚫 DO NOT:
                - Repeat "Hello" or greetings in follow-up messages.
                - Mention the same book again unless user asks.
                - Repeat the price if it was already stated.
                - Mention books that are not in Available Books.

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
            'model' => 'gemma3:4b',
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
