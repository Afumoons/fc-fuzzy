<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FuzzyController;

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

Route::get('/mail', function () {
    return Inertia::location("mailto:afumoons@gmail.com");
})->name('mail');

Route::get('/github', function () {
    return Inertia::location("https://github.com/afumoons");
})->name('github');

Route::get('/whatsapp', function () {
    return Inertia::location("https://wa.me/+6287744554566");
})->name('whatsapp');

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/data', [FrontController::class, 'data'])->name('data');
Route::get('/riwayat', [FrontController::class, 'history'])->name('history');
Route::get('/fuzzycoba', [FuzzyController::class, 'index'])->name('fuzzycoba');

Route::get('test', function () {
    dd('gatau');
});

/* ################### BEGIN : AUTHENTICATED USER ROUTE HERE #################### */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/diagnosis', [FrontController::class, 'diagnosis'])->name('diagnosis');
    Route::post('/mendiagnosis', [FrontController::class, 'diagnosingPost'])->name('diagnosing.post');
    Route::post('/mendiagnosis2', [FrontController::class, 'diagnosingPost2'])->name('diagnosing.post2');
    Route::get('/hasil-diagnosis/{rulebaseHistory?}', [FrontController::class, 'diagnosisResult'])->name('diagnosisResult');
    Route::post('/pembobotan-fuzzy', [FrontController::class, 'fuzzyingPost'])->name('fuzzying.post');
    Route::post('/pembobotan-fuzzy2', [FrontController::class, 'fuzzyingPost2'])->name('fuzzying.post2');
});
/* ################### END : AUTHENTICATED USER ROUTE HERE #################### */

/* ################### BEGIN : ADMIN ROUTE HERE #################### */
Route::prefix('/admin')->middleware(['can:isAdmin'])->name('admin.')->group(function () {
    /* ################### BEGIN : DISEASE ROUTE HERE #################### */
    Route::prefix('/disease')->name('disease.')->group(__DIR__ . '/admin_routes/disease.php');
    /* ################### END : DISEASE ROUTE HERE #################### */

    /* ################### BEGIN : RULEBASE ROUTE HERE #################### */
    Route::prefix('/rulebase')->name('rulebase.')->group(__DIR__ . '/admin_routes/rulebase.php');
    /* ################### END : RULEBASE ROUTE HERE #################### */

    /* ################### BEGIN : FUZZY ROUTE HERE #################### */
    Route::prefix('/fuzzy')->name('fuzzy.')->group(__DIR__ . '/admin_routes/fuzzy.php');
    /* ################### END : FUZZY ROUTE HERE #################### */

    /* ################### BEGIN : SYMPTOM ROUTE HERE #################### */
    Route::prefix('/symptom')->name('symptom.')->group(__DIR__ . '/admin_routes/symptom.php');
    /* ################### END : SYMPTOM ROUTE HERE #################### */

    /* ################### BEGIN : RULEBASEHISTORY ROUTE HERE #################### */
    Route::prefix('/rulebaseHistory')->name('rulebaseHistory.')->group(__DIR__ . '/admin_routes/rulebaseHistory.php');
    /* ################### END : RULEBASEHISTORY ROUTE HERE #################### */
});
/* ################### END : ADMIN ROUTE HERE #################### */

/* ################### BEGIN : AUTH ROUTE HERE #################### */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/* ################### END : AUTH ROUTE HERE #################### */

require __DIR__ . '/auth.php';
