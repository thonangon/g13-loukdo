<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Categories\CategoryController;
// use App\Http\Controllers\Products\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');

// crud on categories
Route::get('/categories/list', [CategoryController::class, 'index']);
Route::post('/create/category', [CategoryController::class, 'store']);

// Other routes that don't require authentication
Route::put('/update/category/{id}', [CategoryController::class, 'update']);
Route::delete('/delete/category/{id}', [CategoryController::class, 'destroy']);

// // Product Routes
// Route::prefix('products')->group(function () {
//     Route::get('/list', [ProductController::class, 'index']);
//     Route::post('/create', [ProductController::class, 'store']);
//     Route::get('/view/{id}', [ProductController::class, 'show']);
//     Route::put('/update/{id}', [ProductController::class, 'update']);
//     Route::delete('/remove/{id}', [ProductController::class, 'destroy']);
// });



// Product Routes
Route::middleware('auth:sanctum')->prefix('products')->group(function () {
    Route::get('/list', [PostController::class, 'index']);
    Route::post('/create', [PostController::class, 'store']);
    Route::get('/view/{id}', [PostController::class, 'show']);
    Route::put('/update/{id}', [PostController::class, 'update']);
    Route::delete('/remove/{id}', [PostController::class, 'destroy']);
});
