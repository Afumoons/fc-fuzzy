<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DiseaseController;

// api.disease -> api/disease
Route::get('/', [DiseaseController::class, 'index'])->name('index');
Route::get('/{disease}', [DiseaseController::class, 'show'])->name('show');
