<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return
        '<pre>' . file_get_contents('/app/README.md') . '</pre>';
});
