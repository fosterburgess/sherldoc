<?php
namespace App\Actions;

use Cloudstudio\Ollama\Facades\Ollama;
use Symfony\Component\Process\Process;

class LLMPdfDoc
{

    public function __invoke($pageText): array
    {
        $prompt = "Keep it short: Take the following text and tell me if there are any contradictions in it?\n";
        $prompt .= $pageText;
        $response = Ollama::agent('You are a weather expert...')
            ->prompt($prompt)
            ->model('llama3:8b-instruct-q2_K')
            ->options(['temperature' => 0.8])
            ->stream(false)
            ->ask();
        dd($response);
    }


}
