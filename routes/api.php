<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CategoryController as ApiCategoryController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ProductController as ApiProductController;
use App\Http\Controllers\api\RajaOngkirController;
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/check_ongkir', function () {
    dd('test');
});

Route::post('/transaction/confirm', [TransactionController::class, 'confirmation_status']);
Route::post('/transaction/accepted', [TransactionController::class, 'accepted_status']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/categories', [ApiCategoryController::class, 'get_category']);
Route::get('/categories/{slug}', [ApiCategoryController::class, 'show']);
Route::get('/products', [ApiProductController::class, 'get_products']);
Route::get('/products/{slug}', [ApiProductController::class, 'show']);
Route::get('/provinces', [RajaOngkirController::class, 'get_provinces']);
Route::get('/city/{provinceId}', [RajaOngkirController::class, 'get_city']);
Route::post('/check_ongkir', [RajaOngkirController::class, 'check_ongkir']);
Route::post('/midtrans', [TransactionController::class, 'payment']);
Route::post('/midtrans-callback', [TransactionController::class, 'callback']);
Route::post('/midtrans-success', [TransactionController::class, 'callbackSuccess']);


Route::group(["middleware" => ["auth:api"]], function () {
    Route::post('/cart/checkout', [CartController::class, 'checkout']);
    Route::get('/get-order', [TransactionController::class, 'get']);
    Route::post('/order', [TransactionController::class, 'store']);
    Route::post('/cart/{id}', [CartController::class, 'addToProduct']);
    Route::patch('/cart/{id}', [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'delete']);
    Route::get('/cart', [CartController::class, 'show']);
   
});
