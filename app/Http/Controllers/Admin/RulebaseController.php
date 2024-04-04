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
    public function edit(Disease $disease)
    {
        $disease = Disease::with('rulebases')->findOrFail($disease->id);

        $symptoms = Symptom::get();
        return Inertia::render('Admin/Rulebase/Edit', [
            'isAdmin' => Gate::allows('isAdmin'),
            'disease' => $disease,
            'symptoms' => $symptoms,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRulebaseRequest $request, Disease $disease)
    {
        $validatedData = $request->validated();
        $rulebases = Rulebase::where('disease_id', $disease->id)->delete();
        $symptoms = Symptom::get();
        foreach ($symptoms as $key => $symptom) {
            $exist = false;
            foreach ($validatedData['rulebases'] as $key => $rulebase) {
                try {
                    if ($rulebase['symptom_id'] == $symptom->id) {
                        $exist = true;
                        Rulebase::create([
                            'disease_id' => $disease->id,
                            'symptom_id' => $symptom->id,
                            'value' => $rulebase['value'] == "true" ? true : false,
                        ]);
                    }
                } catch (\Throwable $th) {
                }
            }
            if (!$exist) {
                Rulebase::create([
                    'disease_id' => $disease->id,
                    'symptom_id' => $symptom->id,
                    'value' => false,
                ]);
            }
        }
        return to_route('admin.rulebase.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rulebase $rulebase)
    {
        //
    }
}
