<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Pgvector\Laravel\HasNeighbors;
use Pgvector\Laravel\Vector;

class Chunk extends Model
{
    use HasFactory;
    use HasNeighbors;

    protected $guarded = ['id'];

    protected $casts = [
        'embedding_768' => Vector::class,
        'embedding_3072' => Vector::class,
        'embedding_1536' => Vector::class,
        'embedding_2048' => Vector::class,
        'embedding_1024' => Vector::class,
        'embedding_4096' => Vector::class,
        'meta_data' => 'array',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}