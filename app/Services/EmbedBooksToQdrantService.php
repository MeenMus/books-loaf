<?php

namespace App\Services;

use App\Models\Book;
use App\Services\EmbeddingService;
use App\Services\QdrantService;

class EmbedBooksToQdrantService
{
    protected EmbeddingService $embedder;
    protected QdrantService $qdrant;

    public function __construct(EmbeddingService $embedder, QdrantService $qdrant)
    {
        $this->embedder = $embedder;
        $this->qdrant = $qdrant;
    }

    public function upsert(Book $book): bool
    {
        $genreList = $book->genres->pluck('name')->implode(', ');
        $text = "{$book->title} by {$book->author}. Genres: {$genreList}. {$book->description}";

        $embedding = $this->embedder->getEmbedding($text);

        if (!$embedding || count($embedding) !== 768) {
            return false;
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

        return $this->qdrant->addVector('books', $book->id, $embedding, $payload);
    }
}
