<?php
namespace App\Actions;

use Cloudstudio\Ollama\Facades\Ollama;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class LLMPdfDoc
{

    public function __invoke(array $pageText, string $agent, string $prompt, int $size = 999999): array
    {
        $prompt .= substr(join(", ", $pageText), 0, $size);
        $response = Ollama::agent($agent)
            ->prompt($prompt)
            ->model('llama3:8b-instruct-q2_K')
            ->options(['temperature' => 0.8])
            ->stream(false)
            ->ask();

        return $response;
    }


}
