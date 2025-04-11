<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Group routes under the 'auth' prefix
Route::group(['prefix' => 'auth'], function ($router) {
    //// Public route for user registration and login
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class, 'login']);
});


// Group routes that require authentication 
Route :: middleware(['auth:api'])->group(function(){
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('profile',[AuthController::class,'profile']);
    Route::post('/comments',[CommentController::class,'store']);
    Route::apiResource('posts',PostsController::class);
});


