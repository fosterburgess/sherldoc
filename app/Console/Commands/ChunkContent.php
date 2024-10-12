<?php

namespace App\Console\Commands;

use App\Actions\ChunkText;
use App\Models\Chunk;
use App\Models\Document;
use Illuminate\Console\Command;

class ChunkContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:chunk-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(string $content, string $title = null): Document
    {
        $document = new Document();
        $document->title = $title;
        $document->contents = $content;
        $document->extracted_at = now();
        $document->save();
        $chunks = (new ChunkText)($content);
        foreach ($chunks as $chunkSection => $chunk) {
            $page_number = 1;
            Chunk::create(
                [
                    'section_number' => $chunkSection,
                    'content' => $chunk,
                    'document_id' => $document->id,
                    'sort_order' => $page_number,
                ]);
        }

        return $document;
    }
}

