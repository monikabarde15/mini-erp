<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Dashboard (all authenticated users)
Route::get('/redirect', function () {
    if (auth()->user()->role === 'admin') {
        return redirect('/dashboard');
    }

    // salesperson landing page
    return redirect()->route('sales-orders.index');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// PDF invoice (all authenticated users)
Route::get('/sales-orders/{id}/pdf', [SalesOrderController::class, 'exportPdf'])->name('sales-orders.pdf');

// Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('products', ProductController::class);
});

// Admin or Salesperson
Route::middleware(['auth', 'role:admin,salesperson'])->group(function () {
    Route::resource('sales-orders', SalesOrderController::class)->only(['index', 'create', 'store', 'show']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
