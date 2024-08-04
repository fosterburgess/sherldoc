<?php

use App\Http\Controllers\Api\ScanController;
use Illuminate\Support\Facades\Route;

Route::any('/scan', [ScanController::class, 'scan']);
//    ->middleware(['auth:sanctum', 'abilities:document-scan']);
