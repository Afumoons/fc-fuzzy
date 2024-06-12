<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FuzzyController;

// admin.fuzzy -> admin/fuzzy
Route::get('/', [FuzzyController::class, 'index'])->name('index');
Route::get('/dt/conducting-inspection/ajax', [FuzzyController::class, 'DtConductingInspectionList'])->name('dt.conducting-inspection.ajax');
Route::get('/create', [FuzzyController::class, 'create'])->name('create');
Route::post('/store', [FuzzyController::class, 'store'])->name('store');
Route::get('/{disease}', [FuzzyController::class, 'show'])->name('show');
Route::get('/edit/{fuzzyRule}', [FuzzyController::class, 'edit'])->name('edit');
Route::post('/edit/{fuzzyRule}', [FuzzyController::class, 'update'])->name('update');
