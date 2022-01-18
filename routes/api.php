<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostLikeController;
use App\Http\Controllers\Post\PostCommentController;
use App\Http\Controllers\Post\CommentReplyController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('posts', PostController::class);
    Route::apiResource('posts.comments', PostCommentController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('comments.replies', CommentReplyController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('posts.likes', PostLikeController::class)->only(['store', 'destroy']);
});