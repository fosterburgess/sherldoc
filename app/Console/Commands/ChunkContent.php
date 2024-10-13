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
    public function handle(Document $document, $content, int $chunkSize = 150): Document
    {
        $chunks = (new ChunkText)($content, $chunkSize);
        foreach ($chunks as $chunkSection => $chunk) {
            $page_number = 1;
            Chunk::create(
                [
                    'section_number' => $chunkSection,
                    'content' => $chunk,
                    'chunk_size' => $chunkSize,
                    'document_id' => $document->id,
                    'sort_order' => $page_number,
                ]);
        }

        return $document;
    }
}

