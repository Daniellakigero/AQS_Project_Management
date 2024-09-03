<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
Route::post('/login',[LoginAuthController::class,'login'])->name('login');

Route::get('/login_page', function () {
    return view('login');
});

Route::get('/employee', function () {
    return view('employee');
});

Route::get('create', function () {
    return view('create');
});

Route::post('/create_employee', [EmployeeController::class, 'createEmployee'])->name('createEmployee');

Route::get('/check-session', function () {
    $hodId = session('hod_id');
    $hodName = session('hod_name');
   
    
    return  $hodId ;
});


Route::post('/create_project', [ProjectController::class, 'createProject'])->name('createProject');

Route::get('/check-session', function () {
    return session('hod_id') ?? 'No HOD ID in session';
});
