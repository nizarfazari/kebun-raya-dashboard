<?php


use App\Http\Controllers\web\AuthController as WebAuthController;
use App\Http\Controllers\web\CategoryController as WebCategoryController;
use App\Http\Controllers\web\ProductController as WebProductController;
use App\Http\Controllers\web\OrderController as WebOrderController;
use App\Http\Controllers\web\DashboardController as WebDashboardController;
use App\Http\Controllers\web\ReportController as WebReportController;
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
    return redirect('/auth/login');
});



Route::middleware(['guest'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [WebAuthController::class, 'index'])->name('login');
        Route::post('/login-process', [WebAuthController::class, 'login_process'])->name('login-process');
        Route::get('/register', [WebAuthController::class, 'register'])->name('register');
        Route::post('/register_process', [WebAuthController::class, 'register_process'])->name('register_process');
    });
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [WebAuthController::class, 'logout'])->name('logout');
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [WebCategoryController::class, 'index'])->name('index');
        Route::get('/create', [WebCategoryController::class, 'create'])->name('create');
        Route::post('/store', [WebCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [WebCategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [WebCategoryController::class, 'update'])->name('update');
    });
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [WebDashboardController::class, 'index'])->name('index');
    });
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [WebOrderController::class, 'index'])->name('index');
        Route::get('/create', [WebOrderController::class, 'create'])->name('create');
        Route::post('/add-to-cart/{id}',  [WebOrderController::class, 'addToCart'])->name('addToCart');
        Route::post('/upload_receipt', [WebOrderController::class, 'upload_receipt'])->name('upload_receipt');
        Route::get('/barang-keluar', [WebOrderController::class, 'export_pdf'])->name('barang-keluar');
    });
    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/', [WebReportController::class, 'index'])->name('index');
        Route::get('/detail', [WebReportController::class, 'show'])->name('detail');
    });

    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [WebProductController::class, 'index'])->name('index');
        Route::get('/create', [WebProductController::class, 'create'])->name('create');
        Route::post('/store', [WebProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [WebProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [WebProductController::class, 'update'])->name('update');
    });
});
