<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RulebaseController;

// api.rulebase -> api/rulebase
Route::get('/', [RulebaseController::class, 'index'])->name('index');
Route::get('/{disease}', [RulebaseController::class, 'show'])->name('show');
