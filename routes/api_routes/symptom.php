<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SymptomController;

// admin.symptom -> admin/symptom
Route::get('/', [SymptomController::class, 'index'])->name('index');
Route::get('/{symptom}', [SymptomController::class, 'show'])->name('show');
