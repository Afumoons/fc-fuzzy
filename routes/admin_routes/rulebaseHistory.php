<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RulebaseHistoryController;

// admin.rulebaseHistory -> admin/rulebaseHistory
// Route::get('/', [RulebaseHistoryController::class, 'index'])->name('index');
// Route::get('/dt/conducting-inspection/ajax', [RulebaseHistoryController::class, 'DtConductingInspectionList'])->name('dt.conducting-inspection.ajax');
// Route::get('/create', [RulebaseHistoryController::class, 'create'])->name('create');
// Route::post('/store', [RulebaseHistoryController::class, 'store'])->name('store');
// Route::get('/{rulebaseHistory}', [RulebaseHistoryController::class, 'edit'])->name('edit');
// Route::post('/{rulebaseHistory}', [RulebaseHistoryController::class, 'update'])->name('update');
Route::get('/destroy/{rulebaseHistory}', [RulebaseHistoryController::class, 'destroy'])->name('destroy');
