<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/registration', 'register');
    Route::post('/login', 'login');
});

Route::controller(ProjectController::class)->prefix('/projects')->group(function () {
    Route::get('/','index');
    Route::post('/create', 'store');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::controller(PostController::class)->prefix('/posts')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');

    Route::post('/{id}/like', 'storeLike');//->middleware('auth:sanctum');
    Route::delete('/{id}/like', 'deleteLike');//->middleware('auth:sanctum');
});
