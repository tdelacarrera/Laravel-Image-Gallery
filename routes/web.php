<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;


Route::get('/', [ImageController::class, 'publicIndex']);
Route::get('images', [ImageController::class, 'publicIndex'])->name('images.index');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';