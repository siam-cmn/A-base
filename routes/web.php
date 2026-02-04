<?php

use App\Http\Controllers\SpecMatrixController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\WorkOS\Http\Middleware\ValidateSessionWithWorkOS;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware([
    'auth',
    ValidateSessionWithWorkOS::class,
])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/projects/{project}/matrix', [SpecMatrixController::class, 'showMatrixPage']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
