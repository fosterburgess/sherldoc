<?php

namespace App\Actions;

use Vaites\ApacheTika\Client;

class GetTextFromFile
{
    public function __invoke(string $pathToFile): string
    {
        $url = config('tika.url');
        $client = Client::make($url);
        $client->setTimeout(config('tika.timeout', 80));

        return $client->getText($pathToFile);
    }
}
