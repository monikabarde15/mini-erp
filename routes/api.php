<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;


Route::post('/login', function (Request $req) {
    $user = App\Models\User::where('email', $req->email)->firstOrFail();
    if (!\Illuminate\Support\Facades\Hash::check($req->password, $user->password)) {
        return response()->json(['message'=>'Invalid credentials'], 401);
    }
    return response()->json(['token'=>$user->createToken('api')->plainTextToken]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products',        [ProductController::class,    'index']);
    Route::post('/sales-orders',   [SalesOrderController::class, 'store']);
    Route::get('/sales-orders/{id}', [SalesOrderController::class, 'show']);
});
