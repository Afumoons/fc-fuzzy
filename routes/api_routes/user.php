<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// admin.user -> admin/user
Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/{user}', [UserController::class, 'show'])->name('show');
