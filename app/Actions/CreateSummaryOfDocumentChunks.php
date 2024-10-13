<?php
namespace App\Actions;

use App\Models\Chunk;
use App\Models\Document;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CreateSummaryOfDocumentChunks
{

    public function __invoke(Document $document, int $chunkWordSize = 800, string $prompt = '')
    {
        $time = microtime(true);
        $chunks = $document->chunks->filter(function ($chunk) use ($chunkWordSize) {
            return $chunk->chunk_size === $chunkWordSize;
        });
        $chunksSummaries = $chunks->pluck('summary');
        $summaryChunks = implode("\n", $chunksSummaries->toArray());

        $prompt .= <<<PROMPT
# instructions
As a helpful research assistant, the collection of document summaries needs to be combined in
to one descriptive summary of about three to five sentences.
Never add any additional information, introduction or commentary,
just return the few sentences in the combined summary.

# summary collection
$summaryChunks
PROMPT;
dd($prompt);
        Log::info($prompt);
        $url = config('ollama.url')."/api/generate";
        $model = config('ollama.model');

        $results = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ollama',
        ])
            ->timeout(180)
            ->post($url, [
                'model' => $model,
                'stream' => false,
                'prompt' => $prompt,
            ])->json();

        $document->summary = $results['response'];
        $document->save();
    }


}
