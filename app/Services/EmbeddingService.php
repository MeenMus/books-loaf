<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class EmbeddingService
{
    protected $endpoint = 'http://localhost:11434/api/embeddings';

    public function getEmbedding(string $text): ?array
    {
        $response = Http::post($this->endpoint, [
            'model' => 'nomic-embed-text',
            'prompt' => $text,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['embedding'] ?? null;  // Ollama returns embedding under 'embedding' key
        }

        return null;
    }
}