<?php
namespace App\Actions;

use App\Models\Chunk;
use App\Models\Document;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CreateSummaryForDocumentChunks
{

    public function __invoke(Document $document, int $chunkWordSize = 800, string $prompt = '')
    {
        $time = microtime(true);
        foreach ($document->chunks->filter(function ($chunk) use ($chunkWordSize) { return $chunk->chunk_size === $chunkWordSize; }) as $index=>$chunk) {
            Log::info("Creating summary for chunk $index of {$document->chunks->count()} for document {$document->id}");
            app(CreateSummaryForChunk::class)($chunk, $prompt);
        }
    }


}
