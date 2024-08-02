<?php

use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GeneralController::class, 'index'])->name('home');
Route::post('/scan', [GeneralController::class, 'scan'])->name('scan');
