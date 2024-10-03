<?php
namespace App\Actions;

use App\Models\Document;
use Illuminate\Support\Facades\Http;

class SummarizeDocContents
{

    public function __invoke(Document $document)
    {
        $time = microtime(true);
        $url = config('ollama.url')."/api/generate";
        $model = config('ollama.model');

        $prompt = "Please provide a very short summary of the following text, using no more than 3-4 short sentences. Try to boil it down to the essence without adding your own details:\n".$document->contents;

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
//        $done = microtime(true) - $time;
    }


}
