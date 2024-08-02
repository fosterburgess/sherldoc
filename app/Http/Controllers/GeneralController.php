<?php

namespace App\Http\Controllers;


use App\Actions\ProcessPdfDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GeneralController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function scan(Request $request)
    {
        $file = $request->file('file');
        $prompt = $request->get('prompt');
        $ensureMissing = collect(explode("\n", $request->get('ensure_missing')));
        $ensureExisting = collect(explode("\n", $request->get('ensure_existing')));
        $ensureMissing = $ensureMissing->map(fn($item) => trim($item));
        $ensureExisting = $ensureExisting->map(fn($item) => trim($item));

        $cacheKey = 'test';
        $output = Cache::get($cacheKey);
        if(!$output) {
            $output = (app()->make(ProcessPdfDoc::class))($file->path(), $ensureMissing->toArray(), $ensureExisting->toArray(), $prompt);
//            Cache::put($cacheKey, $output, 90);
        }

        return view('scan', ['prompt' => $prompt, 'output' => $output['output'], 'llmResponse' => $output['llmResponse']]);
    }
}
