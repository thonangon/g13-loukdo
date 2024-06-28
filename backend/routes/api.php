<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Products\RateProductController;
use App\Http\Controllers\Products\CommentProductController;
use App\Http\Controllers\ReplyProduct\ReplyCommentController;

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
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');

Route::get('/user/list', [AuthController::class, 'listUser']);

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
});

// Route::get('/products/image/{id}', [ProductController::class, 'getImage']);

Route::middleware('auth:sanctum')->prefix('products')->group(function () {
    // Route::get('/list', [ProductController::class, 'index']);
    Route::post('/create', [ProductController::class, 'store']);
    Route::get('/view/{id}', [ProductController::class, 'show'])->name('products.view');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/remove/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/ratings/{productId}', [ProductController::class, 'getProductRatings']);

    Route::get('/image/{id}', [ProductController::class, 'getImage']);

});

Route::middleware('auth:sanctum')->prefix('products')->group(function () {
    Route::post('/rate/{productId}', [RateProductController::class, 'rate']);
    Route::delete('/remove/{productId}', [RateProductController::class, 'removeRating']);
    Route::get('/ratings/{productId}', [RateProductController::class, 'getRatings']);
});


// Comment Products Routes
Route::prefix('comment')->group(function () {
    Route::get('/list', [CommentProductController::class, 'index']);
    Route::post('/create', [CommentProductController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/view/{id}', [CommentProductController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/update/{id}', [CommentProductController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/remove/{id}', [CommentProductController::class, 'destroy'])->middleware('auth:sanctum');
});
// // chart messages
// Route::prefix('messages')->group(function () {
//     Route::post('/send', [CommentProductController::class, 'store'])->middleware('auth:sanctum');
//     Route::get('/view/{id}', [CommentProductController::class, 'show']);
//     Route::put('/update/{id}', [CommentProductController::class, 'update']);
//     Route::delete('/remove/{id}', [CommentProductController::class, 'destroy']);

// reply comments to products
Route::prefix('reply')->group(function () {
    Route::get('/list', [ReplyCommentController::class, 'index']);
    Route::post('/create', [ReplyCommentController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/update/{id}', [ReplyCommentController::class, 'update']);
    Route::delete('/remove/{id}', [ReplyCommentController::class, 'destroy']);
});






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


Route::get('/user/{id}', [UserProfileController::class, 'show']);
Route::post('/user/update/{id}', [UserProfileController::class, 'update']);
