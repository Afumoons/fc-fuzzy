<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DiseaseController;

// admin.disease -> admin/disease
Route::get('/', [DiseaseController::class, 'index'])->name('index');
Route::get('/dt/conducting-inspection/ajax', [DiseaseController::class, 'DtConductingInspectionList'])->name('dt.conducting-inspection.ajax');
Route::get('/create', [DiseaseController::class, 'create'])->name('create');
Route::post('/store', [DiseaseController::class, 'store'])->name('store');
Route::get('/{disease}', [DiseaseController::class, 'edit'])->name('edit');
Route::post('/{disease}', [DiseaseController::class, 'update'])->name('update');
Route::get('/destroy/{disease}', [DiseaseController::class, 'destroy'])->name('destroy');
