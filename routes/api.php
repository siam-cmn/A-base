<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SpecMatrixController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
});

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/{project}', [ProjectController::class, 'show']);
    Route::post('/', [ProjectController::class, 'store']);
    Route::put('/{project}', [ProjectController::class, 'update']);
    Route::delete('/{project}', [ProjectController::class, 'destroy']);
    Route::get('/{project}/matrix', [SpecMatrixController::class, 'getPermissionMatrix']);
});
//    ->middleware('can:view,project');

//    ->middleware('auth:sanctum');
