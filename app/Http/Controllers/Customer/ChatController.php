<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Book;
use App\Models\ChatMessage;
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

        // 📝 Save user message
        ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'user',
            'message' => $userMessage,
        ]);

        $genreFilter = null;
        $priceFilter = null;

        // Genre detection
        $genres = Genre::pluck('name')->map(fn($g) => strtolower($g))->toArray();
        foreach ($genres as $genre) {
            if (str_contains($userMessage, $genre)) {
                $genreFilter = $genre;
                break;
            }
        }

        // Budget detection
        if (preg_match('/under\s*\$?(\d+)/', $userMessage, $matches)) {
            $priceFilter = floatval($matches[1]);
        }

        // Get liked/carted/purchased books
        $likedBooks = $user->likes()->with('book.genres')->get()->pluck('book');
        $cartBooks = $user->cart ? $user->cart->items()->with('book.genres')->get()->pluck('book') : collect();
        $purchasedBooks = $user->orders()
            ->with(['orderItems.book.genres'])
            ->get()
            ->flatMap(fn($order) => $order->orderItems->pluck('book'))
            ->unique('id');

        $formatBooks = fn($books) => $books->take(5)->map(
            fn($b) =>
            "- *{$b->title}* – RM " . number_format($b->price, 2) . " (Stock: {$b->stock})"
        )->implode("\n");


        $likesContext = $formatBooks($likedBooks);
        $cartContext = $formatBooks($cartBooks);
        $purchasedContext = $formatBooks($purchasedBooks);

        // Vector search
        $embedding = app(EmbeddingService::class)->getEmbedding($userMessage);
        $matchedIds = [];

        if ($embedding && count($embedding) === 768) {
            $qdrantResults = app(QdrantService::class)->search('books', $embedding, 10);
            $matchedIds = collect($qdrantResults['result'] ?? [])->pluck('id')->toArray();
        }

        if (!$embedding || count($embedding) !== 768) {
            // fallback: just recommend recent or bestsellers
            $availableBooks = Book::where('stock', '>', 0)->latest()->limit(20)->get();
        }

        $availableBooks = Book::with('genres')
            ->when(!empty($matchedIds), fn($q) => $q->whereIn('id', $matchedIds), fn($q) => $q->limit(50))
            ->whereNotIn('id', $purchasedBooks->pluck('id'))
            ->where('stock', '>', 0)
            ->when($genreFilter, fn($q) => $q->whereHas('genres', fn($q) => $q->whereRaw('LOWER(name) LIKE ?', ["%$genreFilter%"])))
            ->when($priceFilter, fn($q) => $q->where('price', '<=', $priceFilter))
            ->get();

        $trimmedAvailableBooks = $availableBooks->take(40);
        $availableContext = $formatBooks($trimmedAvailableBooks);

        // ✅ Pull last 10 messages from DB (user and bot)
        $recentMessages = ChatMessage::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get()
            ->reverse(); // To get oldest at the top

        $chatHistory = $recentMessages
            ->map(fn($msg) => ucfirst($msg->sender) . ': ' . $msg->message)
            ->implode("\n");

        // 🔥 Prompt
        // 🤖 Here’s LoafBot’s full prompt
        $prompt = <<<EOT
                You are LoafBot, a friendly and concise virtual book assistant in a cozy bookstore. Your job is to help users find books based only on what’s available and what they’ve liked, carted, or purchased.

                Behavior Rules:
                - Always reply in the same language the user is using (e.g., reply in Malay if the user speaks Malay, reply in Chinese if the user speaks Chinese).
                - Respond warmly, like a friendly bookstore buddy.
                - Avoid repeating greetings like “Hello” more than once.
                - Keep each response to under 3 short sentences.
                - NEVER repeat book titles or prices more than once.
                - Use emojis occasionally (📚, 😊, 💖) to add charm — but don’t overdo it.
                - If the user's message is not related to books or book preferences, gently guide them back to book-related topics with a warm, friendly tone.
                – If the user requests a list of books, show only the title,price and stock. Do not include descriptions.  

                Source Rules:
                - ONLY mention books from the provided "Available Books" list.
                - NEVER invent or guess book titles.
                - If user asks about a book, respond with what it’s about — but never suggest unrelated books unless requested.
                - If no books match, offer to explore genres, themes, or recent arrivals.

                Book Format:
                When you mention a book, follow this format (only once):
                *Title* – RM 39.90 (Stock: 12)

                DO NOT:
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

        // Send to LLM
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama3-70b-8192',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
        ]);

        $responseText = $response->successful()
            ? $response->json('choices.0.message.content') ?? null
            : null;

        // Save bot reply
        ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'bot',
            'message' => $responseText,
        ]);

        $reply = trim($responseText ?? '') ?: "Oops! I couldn't find any good reads for that. Want to explore some bestsellers or cozy picks instead? 📚";

        return response()->json([
            'reply' => $reply,
        ]);
    }

    public function paginatedHistory(Request $request)
    {
        $user = Auth::user();
        $offset = $request->input('offset', 0);
        $limit = 15;

        $messages = ChatMessage::where('user_id', $user->id)
            ->orderBy('created_at', 'desc') // ⬅️ Ascending = oldest first
            ->skip($offset)
            ->take($limit)
            ->get()
            ->values() // Optional but safe
            ->map(fn($msg) => [
                'sender' => $msg->sender,
                'text' => $msg->message,
            ]);

        return response()->json($messages);
    }
}
