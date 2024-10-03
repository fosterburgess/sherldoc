<?php

namespace App\Actions;

use App\Models\Chunk;
use App\Models\Document;
use Faker\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DocumentEmbed
{
    public function __invoke(Document $document): array
    {
        // assume we have 'content' on document already
        $chunkAction = app(ChunkText::class);
        $chunks = $chunkAction($document->contents, 40);
        $url = config('ollama.url')."/api/embeddings";
        $embed = config('ollama.embed_model');

        $newChunks = [];

        $document->chunks->map(fn ($chunk) => $chunk->delete());
        foreach ($chunks as $position => $chunk) {
            $embeddings = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ollama',
            ])->post($url, [
                'model' => $embed,
                'prompt' => $chunk,
            ])->json();

            $embedding = $embeddings['embedding'];

            $newChunks[] = Chunk::create(
                [
                    'content' => $chunk,
                    'document_id' => $document->id,
                    'sort_order' => $position,
                    'embedding_768' => $embedding,
                ]
            );
        }

        return $newChunks;
    }
}
