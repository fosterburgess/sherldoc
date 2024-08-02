<?php
namespace App\Actions;

use Symfony\Component\Process\Process;

class ScanPdfDoc
{

    public function __invoke($pageText): array
    {
        $negativeKeywords = ['license','sale','lease','company', 'transfer', 'perpetuity'];
        $positiveKeywords = ['research', 'santa'];
        $negativePages = (new CheckForNegativeKeywords)->__invoke($pageText, $negativeKeywords);
        $positivePages = (new CheckForPositiveKeywords)->__invoke($pageText, $positiveKeywords);
        return ['negative' => $negativePages, 'positive' => $positivePages];
    }


}
