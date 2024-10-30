<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index'); // List all employees
    Route::get('employees/{id}', [EmployeeController::class, 'show'])->name('employees.show'); // Fetch employee data
    Route::post('employees/create', [EmployeeController::class, 'store'])->name('employees.store'); // Create a new employee
    Route::put('employees/{id}', [EmployeeController::class, 'update'])->name('employees.update'); // Update an existing employee
    Route::delete('employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // Delete an employee





// Route for getting all posts
// Route::get('/posts', [PostController::class, 'index']);

// // Route for creating a new post
// Route::post('/posts', [PostController::class, 'store']);

// // Route for showing a specific post
// Route::get('/posts/{id}', [PostController::class, 'show']);

// // Route for updating a specific post
// Route::put('/posts/{id}', [PostController::class, 'update']);

// // Route for deleting a specific post
// Route::delete('/posts/{id}', [PostController::class, 'destroy']);


