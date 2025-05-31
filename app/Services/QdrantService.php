<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QdrantService
{
    protected $endpoint;
    protected $apiKey;

    public function __construct()
    {
        $this->endpoint = 'https://a1f83c7a-0140-40c5-9aaa-217b30e98ada.europe-west3-0.gcp.cloud.qdrant.io:6333';
        $this->apiKey = env('QDRANT_API_KEY');
    }

    public function addVector($collection, $id, $embedding, $payload)
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->put("{$this->endpoint}/collections/{$collection}/points", [
            'points' => [
                [
                    'id' => $id,
                    'vector' => $embedding,
                    'payload' => $payload,
                ]
            ]
        ]);

        Log::info('Qdrant response:', [
            'status' => $response->status(),
            'body' => $response->json(),
        ]);

        return $response->successful();
    }

    public function search($collection, $embedding, $limit = 5)
    {
        return Http::withHeaders([
            'api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post("{$this->endpoint}/collections/{$collection}/points/search", [
            'vector' => $embedding,
            'limit' => $limit,
        ])->json();
    }

    public function deleteVector($collection, $id)
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post("{$this->endpoint}/collections/{$collection}/points/delete", [
            'points' => [$id],
        ]);

        Log::info('Qdrant delete response:', [
            'status' => $response->status(),
            'body' => $response->json(),
        ]);

        return $response->successful();
    }
}
