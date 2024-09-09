<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\HodController;

// HOD LOGIN PAGE 
Route::get('/login_page', function () {
    return view('login');
});
Route::post('/login',[LoginAuthController::class,'login'])->name('login');


// HOD SIGNUP
Route::get('/hod/signup', function () {
    return view('hod.signup');
})->name('hod.signup.form');

Route::post('/hod/signup', [HodController::class, 'store'])->name('hod.signup');


// PASSWORD RESET FOR HOD

// FORGOT FORM AND SENDLINKRESET
Route::get('forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');


// RESETTNG THE PASSWORD PROVIDED 

Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// CHECK SESSIONS

Route::get('/check-session', function () {
    $hodId = session('hod_id');
    $hodName = session('hod_name');
   
    
    return  $hodId ;
});

Route::get('/check-session', function () {
    return session('hod_id') ?? 'No HOD ID in session';
});


// EMPLOYEE CRUD OPERATION

// EMPLOYEE CREATE
Route::get('/employee', function () {
    return view('employee');
});

Route::get('create', function () {
    return view('create');
});

Route::post('/create_employee', [EmployeeController::class, 'handleForm'])->name('createEmployee');

// EMPLOYEE AUTHENTICATE 

Route::get('/verify/{token}', [EmployeeController::class, 'showResetForm'])->name('show_reset_form');

Route::post('/verify', [EmployeeController::class, 'employee_authenticate'])->name('employee_authenticate');



// EMPLOYEE READ OPERATION
Route::get('/employeeList', [EmployeeController::class, 'getEmployeeAll']);
Route::get('/employee/search', [EmployeeController::class, 'employee_Search']);

Route::get('/employee_search', function () {
    return view('employee_search');
});

// EMPLOYEE UPDATE 
Route::get('/updateEmployee_check', function () {
    return view('updateEmployee_check');
});

Route::put('/employee/edit', [EmployeeController::class, 'employee_edit'])->name('employee.update');

// DELETE EMPLOYEE 

Route::get('/employee_delete', function () {
    return view('employee_delete');
});

Route::delete('/employee/delete', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete');



// PROJECT CRUD OPERATIONS

// CREATE PPROJECT
Route::get('/project_form', function () {
    return view('project_form');
});

Route::get('/project_create', [ProjectController::class, 'create']);




// CRUD OF TEAM

// CREATE A TEAM
Route::get('/team/create', function () {
    return view('team.create');
})->name('team.create');
Route::post('/team/store', [TeamController::class, 'store'])->name('team.store');

// READ A TEAM
Route::get('/team', [TeamController::class, 'read'])->name('team.read');

// // READ A TEAM MEMBER BY ID
Route::get('/team/{id}', [TeamController::class, 'show'])->name('team.show');