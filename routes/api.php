<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalesOrderController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/products', [Api\ProductController::class, 'index']);
//     Route::post('/sales-orders', [Api\SalesOrderController::class, 'store']);
//     Route::get('/sales-orders/{id}', [Api\SalesOrderController::class, 'show']);
// });

Route::middleware('auth:sanctum')->get('/products', [ProductController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sales-orders', [SalesOrderController::class, 'store']);
    Route::get('/sales-orders/{id}', [SalesOrderController::class, 'show']);
});