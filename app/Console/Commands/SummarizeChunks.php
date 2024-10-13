<?php

namespace App\Console\Commands;

use App\Actions\ChunkText;
use App\Actions\CreateSummaryForDocumentChunks;
use App\Actions\DocumentEmbed;
use App\Actions\ExtractTextFromDocument;
use App\Actions\GetTextFromFile;
use App\Models\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SummarizeChunks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:summarize-chunks {docid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Summarize chunks for a given document id';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $document = Document::find($this->argument('docid'));
        app(CreateSummaryForDocumentChunks::class)($document, 800);
    }
}
