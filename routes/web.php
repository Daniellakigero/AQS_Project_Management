<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\HodController;
use App\Http\Controllers\PusherController;


// HOD SIGNUP
// Route::get('/hod/signup', function () {
//     return view('hod.signup');
// })->name('hod.signup.form');
// Route::post('/hod/signup', [HodController::class, 'store']);


// Route::post('/login', [LoginAuthController::class, 'login'])->name('login');
// Route::get('/login', function () {
//     return view('login');
// });


// EMPLOYEE CRUD OPERATION
// Route::get('/employee', function () {
//     return view('employee');
// });
// Route::post('/create_employee', [EmployeeController::class, 'handleForm'])->name('createEmployee');



// Route::get('/verify/{token}', [EmployeeController::class, 'showResetForm'])->name('show_reset_form');
// Route::post('/verify', [EmployeeController::class, 'employee_authenticate'])->name('employee_authenticate');
// Route::get('/employeeList', [EmployeeController::class, 'getEmployeeAll']);
// Route::get('/employee/search', [EmployeeController::class, 'employee_Search']);
// Route::put('/employee/edit', [EmployeeController::class, 'employee_edit'])->name('employee.update');
// Route::delete('/employee/delete', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete');

// CRUD OF TEAM
Route::get('/team/create', function () {
    return view('team.create');
})->name('team.create');
Route::post('/team/store', [TeamController::class, 'store'])->name('team.store');
Route::get('/team', [TeamController::class, 'read'])->name('team.read');
Route::get('/team/{id}', [TeamController::class, 'show'])->name('team.show');
Route::put('/team/edit', [TeamController::class, 'edit'])->name('team.update');
Route::delete('/team/delete', [TeamController::class, 'delete'])->name('team.delete');


// 
Route::get('/',  [PusherController::class, 'index']);
Route::post('/broadcast',  [PusherController::class, 'broadcast']);
Route::post('/receive',  [PusherController::class, 'receive']);
