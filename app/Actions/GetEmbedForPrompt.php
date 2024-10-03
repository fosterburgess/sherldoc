<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

class GetEmbedForPrompt
{
    public function __invoke(string $prompt): array
    {
        $url = config('ollama.url')."/api/embeddings";
        $embed = config('ollama.embed_model');

            $embeddings = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ollama',
            ])->post($url, [
                'model' => $embed,
                'prompt' => $prompt,
            ])->json();

        return $embeddings['embedding'];
    }
}
