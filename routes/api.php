<?php

use App\Models\User;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Rulebase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* ################### BEGIN : USER ROUTE HERE #################### */
Route::prefix('/user')->name('user.')->group(__DIR__ . '/api_routes/user.php');
/* ################### END : USER ROUTE HERE #################### */

/* ################### BEGIN : DISEASE ROUTE HERE #################### */
Route::prefix('/disease')->name('disease.')->group(__DIR__ . '/api_routes/disease.php');
/* ################### END : DISEASE ROUTE HERE #################### */

/* ################### BEGIN : RULEBASE ROUTE HERE #################### */
Route::prefix('/rulebase')->name('rulebase.')->group(__DIR__ . '/api_routes/rulebase.php');
/* ################### END : RULEBASE ROUTE HERE #################### */

/* ################### BEGIN : SYMPTOM ROUTE HERE #################### */
Route::prefix('/symptom')->name('symptom.')->group(__DIR__ . '/api_routes/symptom.php');
/* ################### END : SYMPTOM ROUTE HERE #################### */
