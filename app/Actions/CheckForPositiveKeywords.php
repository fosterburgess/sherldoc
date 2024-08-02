<?php
namespace App\Actions;

class CheckForPositiveKeywords
{

    public function __invoke(array $pages, array $keywords): array
    {
        $combined = strtolower(join("\n", $pages));
        $found = [];
        foreach($keywords as $keyword) {
            $found[$keyword] = substr_count($combined, strtolower($keyword));
        }
        return $found;
    }


}
