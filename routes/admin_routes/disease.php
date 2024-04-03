<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DiseaseController;

// admin.disease -> admin/disease
Route::get('/', [DiseaseController::class, 'index'])->name('index');
Route::get('/dt/conducting-inspection/ajax', [DiseaseController::class, 'DtConductingInspectionList'])->name('dt.conducting-inspection.ajax');
Route::get('/create', [DiseaseController::class, 'create'])->name('create');
Route::get('/{inspectionSchedule?}', [DiseaseController::class, 'show'])->name('show');
