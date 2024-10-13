<?php
namespace App\Actions;

use Illuminate\Support\Facades\Http;

class AskWithPromptInfo
{

    public function __invoke(string $question, string $extra)
    {
        $time = microtime(true);
        $url = config('ollama.url')."/api/generate";
        $model = config('ollama.model');

        $prompt = "You are a helpful research assisstant.  If you do not know an answer, ask the user to rephrase their question. ";
        $prompt .= "Using this extra information: \n\n=======\n$extra\n======\n\nAnswer the following question: $question";

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

        return $results['response'];
    }


}
