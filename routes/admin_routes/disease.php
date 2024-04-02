<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DiseaseController;

// user-auditee.conducting-inspection -> dashboard/admin/disease
Route::get('/', [DiseaseController::class, 'index'])->name('index');
Route::get('/dt/conducting-inspection/ajax', [DiseaseController::class, 'DtConductingInspectionList'])->name('dt.conducting-inspection.ajax');
Route::get('/{inspectionSchedule?}', [DiseaseController::class, 'show'])->name('show');
Route::get('/{inspectionSchedule?}/kebenaran-data', [DiseaseController::class, 'dataCorrectness'])->name('data-correctness');
Route::get('/{inspectionSchedule?}/achievement', [DiseaseController::class, 'showAchievement'])->name('show.achievement');
Route::post('/{inspectionSchedule?}/achievement', [DiseaseController::class, 'storeAchievement'])->name('store.achievement');
Route::get('/{inspectionSchedule?}/lks', [DiseaseController::class, 'lksShow'])->name('lks.show');
Route::post('/{inspectionSchedule?}/lks', [DiseaseController::class, 'lksStore'])->name('lks.store');
Route::get('/{inspectionSchedule?}/feedback', [DiseaseController::class, 'feedbackShow'])->name('feedback.show');
Route::post('/{inspectionSchedule?}/feedback', [DiseaseController::class, 'feedbackStore'])->name('feedback.store');
Route::get('/{inspectionSchedule?}/ptk', [DiseaseController::class, 'ptkShow'])->name('ptk.show');
Route::post('/{inspectionSchedule?}/ptk', [DiseaseController::class, 'ptkStore'])->name('ptk.store');
Route::get('/{inspectionSchedule?}/report', [DiseaseController::class, 'reportShow'])->name('report.show');
Route::get('/{inspectionSchedule?}/recommendation', [DiseaseController::class, 'recommendationShow'])->name('recommendation.show');
Route::get('/{inspectionSchedule?}/lks/verification', [DiseaseController::class, 'lksVerificationShow'])->name('lks.verification.show');
Route::post('/{inspectionSchedule?}/lks/verification', [DiseaseController::class, 'lksVerificationStore'])->name('lks.verification.store');
