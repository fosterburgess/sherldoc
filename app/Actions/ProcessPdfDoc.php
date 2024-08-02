<?php
namespace App\Actions;

use Symfony\Component\Process\Process;

class ProcessPdfDoc
{

    public function __invoke($pathToPdf): array
    {
        $pageText = (new GetPdfTextInPages)->__invoke($pathToPdf);
//        list($negative, $positive) = (new ScanPdfDoc())->__invoke($pageText);
        $out = (new LLMPdfDoc())->__invoke(join("\n", $pageText));
        dd($out);

        return ['negative' => $negative, 'positive' => $positive];
    }


}
