<?php

use App\Http\Controllers\AuthsController;
use App\Http\Controllers\ProductsController;
use App\Models\Product;
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

// Route::resource('products', ProductsController::class);

// public routes
Route::get('/products', [ProductsController::class, 'index']);
Route::post('/register', [AuthsController::class, 'register']);
Route::post('/login', [AuthsController::class, 'login']);
Route::get('/products/{id}', [ProductsController::class, 'show']);
Route::get('/products/search/{name}', [ProductsController::class, 'search']);
Route::get('/test', function(Request $request){
    return 'Authenticated!!!!!!!!!!!!';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
Route::post('/products', [ProductsController::class, 'store']);
Route::put('/products/{id}', [ProductsController::class, 'update']);
Route::delete('/products/{id}', [ProductsController::class, 'destroy']);
Route::post('/logout', [AuthsController::class, 'logout']);

    
});