<?php

use App\Http\Controllers\ManualController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/introducao', [ManualController::class, '__invoke'])->name('introducao');
