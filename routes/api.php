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
Route::get('users', function () {
    return response()->json(User::get()->toArray());
});
Route::get('diseases', function () {
    return response()->json(Disease::get()->toArray());
});
Route::get('symptoms', function () {
    return response()->json(Symptom::get()->toArray());
});
Route::get('rulebases', function () {
    return response()->json(Rulebase::get()->toArray());
});
