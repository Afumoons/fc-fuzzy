<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SymptomController;

// admin.audit.indikator -> /admin/audit-indikator
Route::get('/', [SymptomController::class, 'index'])->name('index');
Route::get('/add-new', [SymptomController::class, 'create'])->name('add');
Route::post('/add-new', [SymptomController::class, 'store'])->name('store');
Route::get('/assign', [SymptomController::class, 'assign'])->name('assign');
Route::get('/add-assign', [SymptomController::class, 'assignCreate'])->name('assign.create');
Route::post('/add-assign', [SymptomController::class, 'assignStore'])->name('assign.store');
Route::get('/assign/filter', [SymptomController::class, 'dtAssignList'])->name('dt.assign');
Route::get('/assign/{divisionId}/{typeIndikator}', [SymptomController::class, 'assignShow'])->name('assign.show');
Route::get('/show/{indikatorPernyataan}', [SymptomController::class, 'show_js'])->name('show.js');
Route::get('/edit/{indikatorPernyataan}', [SymptomController::class, 'edit'])->name('edit');
Route::put('/update/{indikatorPernyataan}', [SymptomController::class, 'update'])->name('update');
Route::post('/set-indikator/mandatory/{indikatorPernyataan}', [SymptomController::class, 'setMandatory'])->name('mandatory.change');
Route::put('/appointment/inspectionAssign/{indikatorPernyataan}', [SymptomController::class, 'appointment'])->name('appointment');
Route::put('/appointment/inspectionAssign/{divisionId}/{typeIndikator}', [SymptomController::class, 'appointmentAll'])->name('appointment.all');
Route::get('/all-indikator', [SymptomController::class, 'auditDtList'])->name('dt_list');
