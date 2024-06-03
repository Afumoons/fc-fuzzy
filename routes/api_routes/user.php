<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// api.user -> api/user
Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/{user}', [UserController::class, 'show'])->name('show');
Route::post('/', [UserController::class, 'store']);
Route::put('/{user}', [UserController::class, 'update']);
Route::delete('/{user}', [UserController::class, 'destroy']);
