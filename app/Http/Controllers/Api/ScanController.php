<?php

namespace App\Http\Controllers\Api;

use App\Actions\ProcessPdfDoc;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function scan(Request $request): JsonResponse
    {
        $data = $request->get('keywords');
        $data = json_decode($data, true);

        $random = rand(0, 9999) . "-" . microtime(true) . ".pdf";
        $file = $request->file('file');
        $file->move(storage_path('app'), $random);

        $action = app(ProcessPdfDoc::class);
        $output = $action(storage_path('app/') . $random,
            $data['ensure_missing'] ?? [],
            $data['ensure_existing'] ?? []);

        @unlink(storage_path('app/') . $random);

        return response()->json($output);
    }
}
