<?php

use App\Http\Controllers\Api\ScanController;
use Illuminate\Support\Facades\Route;

Route::post('/scan', [ScanController::class, 'scan']);
//->middleware('auth:sanctum');
