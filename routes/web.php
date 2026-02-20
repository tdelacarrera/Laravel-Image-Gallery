<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

 Route::get('/', [ImageController::class, 'index'])->name('index');

Route::resource('images', ImageController::class);
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::get('images/search', [ImageController::class, 'search']);

require __DIR__.'/auth.php';