<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RulebaseController;

// admin.audit.indikator -> /admin/audit-indikator
Route::get('/', [RulebaseController::class, 'index'])->name('index');
Route::get('/add-new', [RulebaseController::class, 'create'])->name('add');
Route::post('/add-new', [RulebaseController::class, 'store'])->name('store');
Route::get('/assign', [RulebaseController::class, 'assign'])->name('assign');
Route::get('/add-assign', [RulebaseController::class, 'assignCreate'])->name('assign.create');
Route::post('/add-assign', [RulebaseController::class, 'assignStore'])->name('assign.store');
Route::get('/assign/filter', [RulebaseController::class, 'dtAssignList'])->name('dt.assign');
Route::get('/assign/{divisionId}/{typeIndikator}', [RulebaseController::class, 'assignShow'])->name('assign.show');
Route::get('/show/{indikatorPernyataan}', [RulebaseController::class, 'show_js'])->name('show.js');
Route::get('/edit/{indikatorPernyataan}', [RulebaseController::class, 'edit'])->name('edit');
Route::put('/update/{indikatorPernyataan}', [RulebaseController::class, 'update'])->name('update');
Route::post('/set-indikator/mandatory/{indikatorPernyataan}', [RulebaseController::class, 'setMandatory'])->name('mandatory.change');
Route::put('/appointment/inspectionAssign/{indikatorPernyataan}', [RulebaseController::class, 'appointment'])->name('appointment');
Route::put('/appointment/inspectionAssign/{divisionId}/{typeIndikator}', [RulebaseController::class, 'appointmentAll'])->name('appointment.all');
Route::get('/all-indikator', [RulebaseController::class, 'auditDtList'])->name('dt_list');
