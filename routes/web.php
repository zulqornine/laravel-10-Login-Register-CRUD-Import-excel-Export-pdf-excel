<?php

use App\Exports\UsersExport;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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




// Rute untuk dashboard superadmin dan admiin


// Buat route dengan HomeController
// Route::get('/dashboard', function () {
//     return view('dashboard'); // kamu bisa ganti dengan controller juga
// })->middleware('auth');
// Grup rute dengan middleware auth

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');

// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk halaman register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Halaman dashboard utama
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware(['auth', 'check.level:superadmin'])->group(function () {
    // Rute untuk UserController - hanya superadmin
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
});

    // // Rute untuk UserController
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Route::get('/users/pdf', [UserController::class, 'exportPDF'])->name('users.pdf');
    // Route::get('/users/excel', function () {
    //     return Excel::download(new UsersExport, 'users.xlsx');
    // })->name('users.excel');
    // Route::post('/users/import', [UserController::class, 'import'])->name('users.import');
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');
    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    // Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    // Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// Halaman dashboard utama
Route::middleware(['auth'])->group(function () {
    // Rute dashboard utama (akan redirect sesuai level user)
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    // Rute dashboard khusus
    Route::get('/dashboard/superadmin', [HomeController::class, 'superAdmin'])->name('superadmin.dashboard');
    Route::get('/dashboard/admin', [HomeController::class, 'admin'])->name('admin.dashboard');

    // Barang
    Route::get('/barangs', [BarangController::class, 'index'])->name('barangs.index');
    Route::get('/barangs/pdf', [BarangController::class, 'exportPDF'])->name('barangs.pdf');
    Route::post('/barangs', [BarangController::class, 'store'])->name('barangs.store');
    Route::get('/barangs/create', [BarangController::class, 'create'])->name('barangs.create');
    Route::get('/barangs/{barang}', [BarangController::class, 'show'])->name('barangs.show');
    Route::get('/barangs/{barang}/edit', [BarangController::class, 'edit'])->name('barangs.edit');
    Route::put('/barangs/{barang}', [BarangController::class, 'update'])->name('barangs.update');
    Route::delete('/barangs/{barang}', [BarangController::class, 'destroy'])->name('barangs.destroy');

    // Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/pdf', [CategoryController::class, 'exportPDF'])->name('categories.pdf');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/cetak-pdf', [OrderController::class, 'exportAllPDF'])->name('orders.pdf');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/pdf', [OrderController::class, 'exportPDF'])->name('orders.exportPDF');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});








