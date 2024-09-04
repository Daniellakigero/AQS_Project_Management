<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HodController;
Route::get('/login_page', function () {
    return view('login');
});
Route::post('/login',[LoginAuthController::class,'login'])->name('login');


// EMPLOYEE CRUD OPERATION

// EMPLOYEE CREATE
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

// CREATE PROJECTS
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/store', [ProjectController::class, 'createProject'])->name('projects.store');

Route::get('/hod/signup', function () {
    return view('hod.signup');
})->name('hod.signup.form');

Route::post('/hod/signup', [HodController::class, 'store'])->name('hod.signup');