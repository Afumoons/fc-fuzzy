<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RulebaseController;

// admin.rulebase -> admin/rulebase
Route::get('/', [RulebaseController::class, 'index'])->name('index');
Route::get('/dt/conducting-inspection/ajax', [RulebaseController::class, 'DtConductingInspectionList'])->name('dt.conducting-inspection.ajax');
Route::get('/create', [RulebaseController::class, 'create'])->name('create');
Route::post('/store', [RulebaseController::class, 'store'])->name('store');
Route::get('/{disease}', [RulebaseController::class, 'edit'])->name('edit');
Route::post('/{disease}', [RulebaseController::class, 'update'])->name('update');
Route::get('/destroy/{rulebase}', [RulebaseController::class, 'destroy'])->name('destroy');
