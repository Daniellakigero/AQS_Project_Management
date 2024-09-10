<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LoginAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginAuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
  Route::post('/project_create', [ProjectController::class, 'create']);
  Route::get('/projects', [ProjectController::class, 'get_all']);
  Route::get('/projects/{id}', [ProjectController::class, 'show']);
  Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy']);
  Route::put('/projects/update/{id}', [ProjectController::class, 'update']);
});

