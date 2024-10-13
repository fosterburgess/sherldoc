<?php

namespace App\Actions;

use App\Models\Chunk;
use App\Models\Document;
use Faker\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DocumentEmbed
{
    public function __invoke(Document $document, int $chunkWordSize = 150): array
    {
        $url = config('ollama.url')."/api/embeddings";
        $embed = config('ollama.embed_model');

        // assume we have 'contents' on document already
        $chunkAction = app(ChunkText::class);
        $chunks = $chunkAction($document->contents, $chunkWordSize);

        $newChunks = [];

        $document->chunks->filter(fn ($chunk) => $chunk->chunk_size === $chunkWordSize)->map(fn ($chunk) => $chunk->delete());
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
                    'chunk_size' => $chunkWordSize,
                    'embedding_768' => $embedding,
                ]
            );
        }

        return $newChunks;
    }
}
