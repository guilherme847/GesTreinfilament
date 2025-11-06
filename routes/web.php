<?php

use App\Http\Controllers\ManualController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
 Route::get(uri:'/introducao', action: ManualController::class);
