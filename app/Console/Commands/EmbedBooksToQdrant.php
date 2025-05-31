<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use App\Services\EmbeddingService;
use App\Services\QdrantService;

class EmbedBooksToQdrant extends Command
{
    protected $signature = 'qdrant:embed-books';
    protected $description = 'Generate embeddings for books and upload to Qdrant';

    public function handle(EmbeddingService $embedder, QdrantService $qdrant)
    {
        $books = Book::with('genres')->get();

        foreach ($books as $book) {
            $genreList = $book->genres->pluck('name')->implode(', ');
            $text = "{$book->title} by {$book->author}. Genres: {$genreList}. {$book->description}";

            $embedding = $embedder->getEmbedding($text);

            if (!$embedding || count($embedding) !== 768) {
                $this->error("Failed or invalid embedding for book ID: {$book->id}");
                continue;
            }

            $payload = [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'isbn' => $book->isbn,
                'genres' => $book->genres->pluck('name')->toArray(),
                'price' => $book->price,
                'stock' => $book->stock,
                'created_at' => $book->created_at->toDateTimeString(),
            ];

            $result = $qdrant->addVector('books', $book->id, $embedding, $payload);

            if (!$result) {
                $this->error("Failed to upload book ID: {$book->id}");
                continue;
            }

            $this->info("Uploaded book: {$book->title}");
        }

        $this->info("All books processed.");
    }
}
