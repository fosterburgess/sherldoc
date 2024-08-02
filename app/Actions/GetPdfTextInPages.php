<?php
namespace App\Actions;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class GetPdfTextInPages
{

    public function __invoke($pathToPdf): array
    {
        $page = 1;
        $pageText = [];
        while($text = $this->getTextFromPage($pathToPdf, $page)) {
            $pageText[$page] = $text;
            $page++;
        }
        return $pageText;
    }

    public function getTextFromPage($pathToPdf, int $page = 1)
    {
        $java = config('pdfbox.java_path');
        $pdfbox = config('pdfbox.pdfbox_jar_path');
        $process = new Process([$java, '-jar', $pdfbox, 'export:text', '-i', $pathToPdf, '-startPage='.$page,'-endPage='.$page, '-console']);
        Log::info($process->getCommandLine());
        $process->run();
        $output = $process->getOutput();
        $strip = 'The encoding parameter is ignored when writing to the console.';
        return trim(str_replace($strip, '', $output));
    }

}
