<?php

namespace App\Http\Controllers\Api;

use App\Models\Symptom;
use App\Http\Controllers\Controller;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Symptom::get()->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Symptom::findOrFail($id)->toArray());
    }
}
