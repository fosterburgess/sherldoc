<?php
namespace App\Actions;

use App\Models\Document;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class ExtractTextFromDocument
{

    public function __invoke(Document $document): void
    {
        $getText = app(GetTextFromFile::class);
        $fullpath = storage_path('app/public/'.$document->document);

        $text = $getText($fullpath);
        $document->contents = $text;
        $document->extracted_at = now();
        $document->save();
    }

}
