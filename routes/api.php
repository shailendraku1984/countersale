<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| Public APIs
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
 
/*
|--------------------------------------------------------------------------
| Protected APIs
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);
	Route::put('/profile', [ProfileController::class, 'update']);
	
	Route::post('/orders', [OrderController::class, 'store']);
	
	Route::get('/orders', [OrderController::class, 'index']);
    
    Route::get('/orders/{id}', [OrderController::class, 'show']);	
	
	Route::get('/cart', [CartController::class, 'index']);

    Route::post('/cart/add', [CartController::class, 'add']);

    Route::post('/cart/sync', [CartController::class, 'sync']);

    Route::put('/cart/update/{productId}', [CartController::class, 'update']);

    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove']);
	
    

    Route::post('/logout', [AuthController::class, 'logout']);
});