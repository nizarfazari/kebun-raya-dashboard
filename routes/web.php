<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['guest'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login-process', [AuthController::class, 'login_process'])->name('login-process');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register_process', [AuthController::class, 'register_process'])->name('register_process');
    });
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
    });
});
