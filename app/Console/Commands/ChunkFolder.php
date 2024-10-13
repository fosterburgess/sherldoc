<?php

namespace App\Console\Commands;

use App\Actions\ChunkText;
use App\Actions\DocumentEmbed;
use App\Actions\ExtractTextFromDocument;
use App\Actions\GetTextFromFile;
use App\Models\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ChunkFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:chunk-folder {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Chunk all files in folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->withProgressBar(File::allFiles($this->argument('path')), function ($file) {
            $getTextFromTika = app(GetTextFromFile::class);
            try {
                $fileName = $file->getFilenameWithoutExtension();
                $mimeType = File::mimeType($file);
                if($mimeType === 'application/pdf') {
                    $content = $getTextFromTika($file);
                } else {
                    return;
                }
                $this->info('Chunking ' . $file);
                $document = new Document();
                $document->title = $fileName;
                $document->contents = $content;
                $document->extracted_at = now();
                $document->save();
//                app(ChunkContent::class)->handle($document, $content, 150);
//                app(ChunkContent::class)->handle($document, $content, 800);
                $this->info("Chunking with chunk size of 150");
                app(DocumentEmbed::class)($document, 150);
                $this->info("Chunking with chunk size of 800");
                app(DocumentEmbed::class)($document, 800);
            } catch (\Throwable $e) {
                dd($e);
                $this->error('Error chunking ' . $file);
            }
        });
    }
}
