<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Rulebase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class FrontController extends Controller
{
    function index()
    {
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    function data()
    {
        return Inertia::render('Data', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'diseases' => Disease::with('rulebases')->get(),
            'symptoms' => Symptom::get(),
            'rulebases' => Rulebase::get(),
        ]);
    }
}
