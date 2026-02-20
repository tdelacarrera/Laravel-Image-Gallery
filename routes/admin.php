<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;


Route::prefix('admin')->middleware(['auth'])->name("admin.")->group(function(){

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
});

