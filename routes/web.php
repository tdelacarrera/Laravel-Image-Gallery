<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

 Route::get('/', [ImageController::class, 'index'])->name('index');


 
//Imagenes
Route::get('images', [ImageController::class, 'index'])->name('images.index');
Route::get('images/search', [ImageController::class, 'search'])->name('images.search');
Route::get('images/create', [ImageController::class, 'create'])->name('images.create')->middleware('auth');
Route::post('images/store', [ImageController::class, 'store'])->name('images.store')->middleware('auth');
Route::get('images/{image}', [ImageController::class, 'show'])->name('images.show');

//Usuarios
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users/store', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::post('users/update/{id}', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::post('users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');
Route::get('users/search', [UserController::class, 'search'])->name('users.search');

//Autenticacion
Route::get('auth/register', [AuthController::class, 'showRegister'])->name('register');
Route::get('auth/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');