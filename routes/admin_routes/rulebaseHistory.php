<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RulebaseHistoryController;

// admin.rulebaseHistory -> admin/rulebaseHistory
Route::get('/destroy/{rulebaseHistory}', [RulebaseHistoryController::class, 'destroy'])->name('destroy');
