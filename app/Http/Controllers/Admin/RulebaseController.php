<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Symptom;
use App\Models\Rulebase;
use App\Models\Disease;
use App\Http\Requests\UpdateRulebaseRequest;
use App\Http\Requests\StoreRulebaseRequest;
use App\Http\Controllers\Controller;

class RulebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diseases = Disease::with('rulebases')->get();
        $symptoms = Symptom::with(['rulebases' => function ($rulebases) {
            $rulebases;
        }])->get();
        $rulebases = Rulebase::get();
        return Inertia::render('Admin/Rulebase/Index', [
            'diseases' => $diseases,
            'symptoms' => $symptoms,
            'rulebases' => $rulebases,
            'isAdmin' => Gate::allows('isAdmin'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rulebase $rulebase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRulebaseRequest $request, Rulebase $rulebase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rulebase $rulebase)
    {
        //
    }
}
