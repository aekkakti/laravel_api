<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'showProducts']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    // работа с продуктами
    Route::post('/add_product', [ProductController::class, 'addProduct']);
    Route::delete('/delete_product/{product}', [ProductController::class, 'deleteProduct']);
    Route::patch('/update_product/{product}', [ProductController::class, 'updateProduct']);
    // работа с заказами
    Route::post('/add_order', [OrderController::class, 'addOrder']);
    Route::delete('/delete_order/{order}', [OrderController::class, 'deleteOrder']);
    Route::patch('/update_order/{order}', [OrderController::class, 'updateOrder']);
    Route::get('/orders', [OrderController::class, 'showOrders']);
});
