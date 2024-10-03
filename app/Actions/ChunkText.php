<?php

namespace App\Actions;

use Illuminate\Support\Str;

class ChunkText
{
    public function __invoke(string $text, int $words = 50): array
    {
        $chunks = [];

        while($text!=='')
        {
            $chunk = Str::words($text, $words, null);
            $newText = substr($text, strlen($chunk));
            $text = trim($newText);
            $chunks[] = $chunk;
        }

        return $chunks;
    }
}
