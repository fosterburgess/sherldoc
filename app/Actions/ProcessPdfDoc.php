<?php

namespace App\Actions;

use Illuminate\Support\Facades\Log;

class ProcessPdfDoc
{

    public function __invoke($pathToPdf, $negativeKeywords = [], $positiveKeywords = [], string $prompt): array
    {
        $pageText = (new GetPdfTextInPages)($pathToPdf);
        $output= (new ScanPdfDoc)($pageText, $negativeKeywords, $positiveKeywords);
        $llmResponse = (new LLMPdfDoc())(
            $pageText,
        "You are a technology transfer professional", $prompt

        );

        return ['output' => $output, 'llmResponse' => $llmResponse['response']];
    }


}
