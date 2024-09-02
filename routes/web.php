<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\EmployeeController;
Route::post('/login',[LoginAuthController::class,'login'])->name('login');
Route::get('/login', function () {
    return view('login');
}); 
Route::get('/employee', function () {
    return view('employee');
});

Route::post('/create_employee', [EmployeeController::class, 'createEmployee'])->name('createEmployee');
