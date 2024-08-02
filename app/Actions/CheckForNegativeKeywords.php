<?php
namespace App\Actions;

class CheckForNegativeKeywords
{

    public function __invoke(array $pages, array $keywords): array
    {
        $foundPages = [];
        $foundWords = [];
        foreach($pages as $page => $text) {
            foreach($keywords as $keyword) {
                if(stripos($text, $keyword) !== false) {
                    if(!array_key_exists($page, $foundPages)) {
                        $foundPages[$page] = [];
                    }
                    if(!array_key_exists($keyword, $foundWords)) {
                        $foundWords[$keyword] = [];
                        $foundWordsc[$keyword][$page] = 0;
                    }
                    $foundWords[$keyword][$page] = substr_count(strtolower($text), strtolower($keyword));
                    $foundPages[$page][] = $keyword;
                }
            }
        }
        return ['pages' => $foundPages, 'words' => $foundWords];
    }


}
