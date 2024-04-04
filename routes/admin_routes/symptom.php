<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SymptomController;

// admin.symptom -> admin/symptom
Route::get('/', [SymptomController::class, 'index'])->name('index');
Route::get('/dt/conducting-inspection/ajax', [SymptomController::class, 'DtConductingInspectionList'])->name('dt.conducting-inspection.ajax');
Route::get('/create', [SymptomController::class, 'create'])->name('create');
Route::post('/store', [SymptomController::class, 'store'])->name('store');
Route::get('/{symptom}', [SymptomController::class, 'edit'])->name('edit');
Route::post('/{symptom}', [SymptomController::class, 'update'])->name('update');
Route::get('/destroy/{symptom}', [SymptomController::class, 'destroy'])->name('destroy');
