<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\CommentProductController;
use App\Http\Controllers\ChartController;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');

// crud on categories
Route::get('/categories/list', [CategoryController::class, 'index']);
Route::post('/create/category', [CategoryController::class, 'store']);
//forgot password
Route::post('user/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('user/reset-password', [AuthController::class, 'resetPassword']);


// Other routes that don't require authentication
Route::put('/update/category/{id}', [CategoryController::class, 'update']);
Route::delete('/delete/category/{id}', [CategoryController::class, 'destroy']);

// Product Routes
Route::prefix('products')->group(function () {
    Route::get('/list', [ProductController::class, 'index']);
    Route::post('/create', [ProductController::class, 'store']);
    Route::get('/view/{id}', [ProductController::class, 'show']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
    Route::delete('/remove/{id}', [ProductController::class, 'destroy']);
});
// Comment Products Routes
Route::prefix('comment')->group(function () {
    Route::get('/list', [CommentProductController::class, 'index']);
    Route::post('/create', [CommentProductController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/view/{id}', [CommentProductController::class, 'show']);
    Route::put('/update/{id}', [CommentProductController::class, 'update']);
    Route::delete('/remove/{id}', [CommentProductController::class, 'destroy']);
});
// // chart messages
// Route::prefix('messages')->group(function () {
//     Route::post('/send', [CommentProductController::class, 'store'])->middleware('auth:sanctum');
//     Route::get('/view/{id}', [CommentProductController::class, 'show']);
//     Route::put('/update/{id}', [CommentProductController::class, 'update']);
//     Route::delete('/remove/{id}', [CommentProductController::class, 'destroy']);
// });

// Route::middleware('auth:sunctum')->group(function () {
//     Route::get('/chat/rooms', [ChartController::class, 'rooms']);
//     Route::get('/chat/messages/{roomId}', [ChartController::class, 'messages']);
//     Route::post('/chat/messages/{roomId}', [ChartController::class, 'newMessage']);
//     Route::post('/chat/room', [ChartController::class, 'createRoom']);
// });



// messages chat
Route::middleware('auth:sanctum')->prefix('message')->group(function () {
    Route::get('/chat/rooms', [ChartController::class, 'rooms']);
    Route::get('/chat/messages/{roomId}', [ChartController::class, 'messages']);
    Route::post('/chat/messages/{roomId}', [ChartController::class, 'newMessage']);
    Route::post('/chat/room', [ChartController::class, 'createRoom']);
});


// customer orders the product
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orderProducts', [OrderController::class, 'store']);
Route::put('/orderProducts/{id}', [OrderController::class, 'update']);
Route::delete('/orderProducts/delete/{id}', [OrderController::class, 'delete']);
