<?php

use App\Http\Controllers\Dashboard\ThemeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------
| Admin Routes
|--------------------------------------------------------
|	All prefixes and names inside Route service providers.
*/

    Route::get('/', ThemeController::class)->name('index');



