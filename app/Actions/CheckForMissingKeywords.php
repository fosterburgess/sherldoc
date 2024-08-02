<?php
namespace App\Actions;

class CheckForMissingKeywords
{

    public function __invoke(array $pages, array $keywords): array
    {
        $combined = strtolower(join("\n", $pages));
        $missing = [];
        foreach($keywords as $keyword) {
            if(substr_count($combined, strtolower($keyword))===0) {
                $missing[$keyword]= true;
            }
        }
        return collect($missing)->keys()->toArray();
    }


}
