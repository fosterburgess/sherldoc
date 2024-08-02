<?php

namespace App\Actions;

use Illuminate\Support\Facades\Log;

class ProcessPdfDoc
{

    public function __invoke($pathToPdf, $negativeKeywords = [], $positiveKeywords = []): array
    {
        $pageText = (new GetPdfTextInPages)($pathToPdf);
        $output= (new ScanPdfDoc)($pageText, $negativeKeywords, $positiveKeywords);

        return $output;
    }


}
