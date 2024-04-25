<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Rulebase;
use App\Models\FuzzyRule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreRulebaseRequest;
use App\Http\Requests\UpdateRulebaseRequest;
use App\Http\Controllers\Admin\AdminController;

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
        return Inertia::render('Admin/Rulebase/Index', (new AdminController)->getViewData([
            'diseases' => $diseases,
            'symptoms' => $symptoms,
            'rulebases' => $rulebases,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disease $disease)
    {
        $disease = Disease::with('rulebases')->findOrFail($disease->id);

        $symptoms = Symptom::get();
        return Inertia::render('Admin/Rulebase/Edit', (new AdminController)->getViewData([
            'disease' => $disease,
            'symptoms' => $symptoms,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRulebaseRequest $request, Disease $disease)
    {
        $validatedData = $request->validated();
        Rulebase::where('disease_id', $disease->id)->delete();
        FuzzyRule::where('disease_id', $disease->id)->delete();
        $symptoms = Symptom::get();
        foreach ($symptoms as $symptom) {
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

        (new FuzzyController)->saveRuleAttributes($disease->rulebases()->where('value', true)->get()->pluck('symptom_id'), (new FuzzyController)->statementArray, $disease);

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
