<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/data', [FrontController::class, 'data'])->name('data');

Route::get('test', function () {
    dd('gatau');
});

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);

/* ################### BEGIN : ADMIN ROUTE HERE #################### */
Route::prefix('/admin')->middleware(['can:isAdmin'])->name('admin.')->group(function () {
    /* ################### BEGIN : MONITORING INDIKATOR ROUTE HERE #################### */
    Route::prefix('/disease')->name('disease.')->group(__DIR__ . '/admin_routes/disease.php');
    /* ################### END : MONITORING INDIKATOR ROUTE HERE #################### */

    /* ################### BEGIN : INDIKATOR AUDIT ROUTE HERE #################### */
    Route::prefix('/rulebase')->name('rulebase.')->group(__DIR__ . '/admin_routes/rulebase.php');
    /* ################### END : INDIKATOR AUDIT ROUTE HERE #################### */

    /* ################### BEGIN : INDIKATOR AUDIT ROUTE HERE #################### */
    Route::prefix('/symptom')->name('symptom.')->group(__DIR__ . '/admin_routes/symptom.php');
    /* ################### END : INDIKATOR AUDIT ROUTE HERE #################### */
});
/* ################### END : ADMIN ROUTE HERE #################### */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
