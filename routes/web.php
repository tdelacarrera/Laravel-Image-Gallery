<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;

 Route::get('/', [ImageController::class, 'index'])->name('index');

 
Route::prefix('images')->name('images.')->group(function() {
    Route::get('', [ImageController::class, 'index'])->name('index');
    Route::get('search', [ImageController::class, 'search'])->name('search');
    Route::get('create', [ImageController::class, 'create'])->name('create');
    Route::post('store', [ImageController::class, 'store'])->name('store');
    Route::get('/{image}', [ImageController::class, 'detail'])->name('detail');
});
Route::prefix('users')->name('users.')->group(function() {
    Route::get('index', [UserController::class, 'index'])->name('index');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::post('update/{id}', [UserController::class, 'update'])->name('update');
    Route::post('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('search', [UserController::class, 'search'])->name('search');
    Route::get('manage', [UserController::class, 'manage'])->name('manage');
});

Route::prefix('auth')->name('auth.')->group(function() {
    Route::get('register', [AuthenticationController::class, 'register'])->name('register');
    Route::get('login', [AuthenticationController::class, 'login'])->name('login');
});
