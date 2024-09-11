<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\HodController;
use App\Http\Middleware\JWTAuthenticate;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// HOD LOGIN
Route::post('/login', [LoginAuthController::class, 'login'])->name('login');

// HOD PASSWORD RESET WITH LINK
Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// HOD SIGNUP
Route::post('/hod/signup', [HODController::class, 'signup']);


// CRUD PROJECTS
Route::middleware(JWTAuthenticate::class)->group(function () {
    Route::post('/project_create', [ProjectController::class, 'create']);
    Route::get('/projects', [ProjectController::class, 'get_all']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy']);
    Route::put('/update/{id}', [ProjectController::class, 'update']);

});


