<?php
namespace App\Actions;

use App\Models\Chunk;
use Illuminate\Support\Facades\Http;

class CreateSummaryForChunk
{

    public function __invoke(Chunk $chunk, string $prompt = '')
    {
        $time = microtime(true);
        $url = config('ollama.url')."/api/generate";
        $model = config('ollama.model');

        $prompt .= <<<PROMPT
As a helpful research assistant, summarize this chunk of text down to a sentence or two at the most.
Never add any additional information, introduction or commentary, just return the summary

PROMPT;

        $prompt .= "Then summarize this chunk of text down to a single sentence: \n\n=======\n$chunk->content\n======\n\n";

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

        $chunk->summary = $results['response'];
        $chunk->save();
    }


}
