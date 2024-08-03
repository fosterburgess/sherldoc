<?php

use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect('/main');
});

Route::post('/scan', [GeneralController::class, 'scan'])->name('scan');
