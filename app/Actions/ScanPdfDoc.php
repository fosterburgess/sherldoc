<?php
namespace App\Actions;

class ScanPdfDoc
{

    public function __invoke($pageText, $negativeKeywords = [], $positiveKeywords = []): array
    {
        $foundKeywords = (new CheckForNegativeKeywords)->__invoke($pageText, $negativeKeywords);
        $missingKeywords = (new CheckForMissingKeywords)->__invoke($pageText, $positiveKeywords);

        return ['found' => $foundKeywords, 'missing' => $missingKeywords];
    }


}
