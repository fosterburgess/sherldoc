<?php

namespace App\Actions;

use App\Models\Chunk;
use Illuminate\Support\Collection;
use Pgvector\Laravel\Distance;
use Pgvector\Vector;

class QueryDocuments
{
    public function __invoke(string $query): array
    {

        $embedAction = app(GetEmbedForPrompt::class);
        $embed = new Vector($embedAction($query));

        $results = Chunk::query()
            ->select('chunks.id','chunks.content','chunks.sort_order', 'documents.name')
            ->join('documents', 'chunks.document_id', '=', 'documents.id')
            ->orderBy('chunks.sort_order')
            ->nearestNeighbors('embedding_768', $embed, Distance::Cosine)
            ->limit(2)
            ->get();

        $done = [];
        $keys = ['id','content','sort_order','name'];
        foreach($results as $result)
        {
            $x = [];
            foreach($keys as $key) {
                $x[$key] = $result[$key];
            }
            $done[] = $x;
        }

        return $done;
    }
}
