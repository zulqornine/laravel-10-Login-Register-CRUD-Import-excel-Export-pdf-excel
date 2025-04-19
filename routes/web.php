<?php

use App\Exports\UsersExport;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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


// Buat route dengan HomeController
Route::get('/', [HomeController::class, 'index'])->name('home');

// Buat route dengan UserController
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/pdf', [UserController::class, 'exportPDF'])->name('users.pdf');
Route::get('/users/excel', function () {
    return Excel::download(new UsersExport, 'users.xlsx');
})->name('users.excel');

Route::post('/users/import', [UserController::class, 'import'])->name('users.import');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');









