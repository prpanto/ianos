<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::get('posts', [PostController::class, 'index']);
Route::post('posts', [PostController::class, 'store']);
Route::get('posts/{post}', [PostController::class, 'show']);
Route::match(['put', 'patch'],'posts/{post}', [PostController::class, 'update']);
Route::delete('posts/{post}', [PostController::class, 'destroy']);

Route::post('posts/{posts}/comments', [CommentController::class, 'store']);
Route::get('posts/{posts}/comments/{comment}', [CommentController::class, 'show']);
Route::match(['put', 'patch'],'posts/{posts}/comments/{comment}', [CommentController::class, 'update']);
Route::delete('posts/{posts}/comments/{comment}', [CommentController::class, 'destroy']);

Route::post('tags', [TagController::class, 'store']);
Route::get('tags/{tag}', [TagController::class, 'show']);
Route::match(['put', 'patch'],'tags/{tag}', [TagController::class, 'update']);
Route::delete('tags/{tag}', [TagController::class, 'destroy']);
