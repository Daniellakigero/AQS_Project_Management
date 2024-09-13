<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\HodController;
use App\Http\Controllers\TaskController; 
use App\Http\Middleware\JWTAuthenticate;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// HOD LOGIN
Route::post('/login', [LoginAuthController::class, 'login']);

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


// CRUD EMPLOYEE 

Route::middleware(JWTAuthenticate::class)->group(function () {
    Route::post('/employees', [EmployeeController::class, 'create_employee']);
    Route::post('/verify', [EmployeeController::class, 'employee_verify']);
    Route::post('/employee/authenticate', [EmployeeController::class, 'employee_authenticate']);
    Route::get('/employeeList', [EmployeeController::class, 'getEmployeeAll']);
    Route::get('/employee/search', [EmployeeController::class, 'employee_Search']);
    Route::put('/employee/edit/{id}', [EmployeeController::class, 'employee_edit']);
    Route::delete('/employee/delete/{id}', [EmployeeController::class, 'deleteEmployee']);
    Route::post('/employee/login', [EmployeeController::class, 'employee_login']);
});


// CRUD TASK

Route::middleware(JWTAuthenticate::class)->group(function () {
    Route::post('/tasks', [TaskController::class, 'create']);
    Route::get('/tasks/list', [TaskController::class, 'tasklist']);
    Route::get('/tasks/list/{id}', [TaskController::class, 'show']);
    Route::put('/tasks/update/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/delete/{id}', [TaskController::class, 'delete']);
});
