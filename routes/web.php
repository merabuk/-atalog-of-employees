<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeCreateController;
use App\Http\Controllers\EmployeeEditController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [AdminController::class, 'index'])->name('admin');
Route::get('/home', [HomeController::class, 'index'])->name('avatar');
Route::resource('/employees', EmployeeController::class)->except(['show']);
Route::post('/employees/get-head', [EmployeeController::class, 'getHead'])->name('employees.get-head');
