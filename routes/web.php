<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;

Route::post('/login',[LoginAuthController::class,'login'])->name('login');
Route::get('/login', function () {
    return view('login');
});