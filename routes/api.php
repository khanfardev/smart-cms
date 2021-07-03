<?php

use App\Http\Controllers\Api\AuthController;
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
Route::post('/login-user', [AuthController::class, 'loginUser']);
Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/logout',[AuthController::class,'logout']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/my-account',[\App\Http\Controllers\Api\AuthController::class,'account']);
    Route::post('/my-account',[\App\Http\Controllers\Api\AuthController::class,'updateAccount']);
    Route::get('/my-posts',[\App\Http\Controllers\Api\PostController::class,'showPosts']);
    Route::post('/post',[\App\Http\Controllers\Api\PostController::class,'createPost']);
    Route::post('/posts/{post}/comments',[\App\Http\Controllers\Api\CommentController::class,'store']);
    Route::patch('/posts-comment/{comment}',[\App\Http\Controllers\Api\CommentController::class,'update']);
    Route::get('/messages',[\App\Http\Controllers\Api\MessageController::class,'index']);
    Route::post('/messages',[\App\Http\Controllers\Api\MessageController::class,'store']);


});
Route::get('/posts', [\App\Http\Controllers\Api\PostController::class, 'index']);
Route::get('/categories',[\App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::get('/posts/{post}',[\App\Http\Controllers\Api\PostController::class,'show']);
Route::get('/pages', [\App\Http\Controllers\Api\PageController::class, 'index']);
Route::get('/pages/{page}', [\App\Http\Controllers\Api\PageController::class, 'show']);
