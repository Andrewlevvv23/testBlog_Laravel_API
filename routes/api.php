<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Маршрути до рандомних постів та коментарів в "json placeholder"
Route::get('/posts', [PostController::class, 'index']);
Route::get('/comments', [CommentController::class, 'index']);
