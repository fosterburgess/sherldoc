<?php

namespace App\Console\Commands;

use App\Actions\ChunkText;
use App\Actions\CreateSummaryForDocumentChunks;
use App\Actions\CreateSummaryOfDocumentChunks;
use App\Actions\DocumentEmbed;
use App\Actions\ExtractTextFromDocument;
use App\Actions\GetTextFromFile;
use App\Models\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SummarizeDocumentFromChunks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:summarize-document {docid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Summarize document from chunks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $document = Document::find($this->argument('docid'));
        $prompt = "You are a helpful research assistant.  If you do not know an answer, ask the user to rephrase their question. ";
        app(CreateSummaryOfDocumentChunks::class)($document, 800, $prompt);
    }
}
