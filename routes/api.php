<?php

use App\Http\Controllers\{Api\AuthController, Api\PostController, Api\ProjectController};
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/registration', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::controller(ProjectController::class)->prefix('/projects')->group(function () {
    Route::get('/','index');
    Route::post('/create', 'store')->middleware('auth:sanctum');
    Route::delete('/{id}/delete', 'destroy')->middleware('auth:sanctum');
});

Route::controller(PostController::class)->prefix('/posts')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');

    Route::post('/{id}/like', 'storeLike')->middleware('auth:sanctum');
    Route::delete('/{id}/like', 'deleteLike')->middleware('auth:sanctum');
});
