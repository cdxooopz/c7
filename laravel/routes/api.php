<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/product', function (Request $request) {
//     return $request->user();
// });
Route::middleware(['auth:sanctum','logRequest','role'])->group(function () {
    Route::get('/backend/product', [ProductController::class, 'index']);
    Route::get('/backend/product/{id}', [ProductController::class, 'show']);
    Route::put('/backend/product/{id}', [ProductController::class, 'update']);
    Route::post('/backend/product', [ProductController::class, 'store']);

    Route::get('/backend/product-category', [ProductTypeController::class, 'index']);
    Route::get('/backend/product-category/{id}', [ProductTypeController::class, 'show']);
    Route::put('/backend/product-category/{id}', [ProductTypeController::class, 'update']);
    Route::post('/backend/product-category', [ProductTypeController::class, 'store']);

    Route::post('/user', 'store');
    
});
Route::middleware('logRequest')->controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
});

Route::middleware('logRequest')->controller(ProductController::class)->group(function () {
    Route::get('/product/{id}', 'show');
    Route::post('/product', 'store');
});
Route::middleware('logRequest')->controller(OrderController::class)->group(function () {
    Route::post('/order', 'store');
});
