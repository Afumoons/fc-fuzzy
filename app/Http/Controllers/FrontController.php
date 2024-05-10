<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Rulebase;
use App\Models\FuzzyTemp;
use App\Models\FuzzyHistory;
use App\Models\RulebaseTemp;
use Illuminate\Http\Request;
use App\Models\FuzzyUserInput;
use Illuminate\Support\Number;
use App\Models\RulebaseHistory;
use App\Models\RulebaseUserInput;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Admin\FuzzyController;

class FrontController extends Controller
{
    public $statementArray;

    public function __construct()
    {
        $this->statementArray = (new FuzzyController)->statementArray;
    }

    public function getViewData(array $data = [])
    {
        $returned = [
            'logoLink' => asset('images/logo-grey.png'),
            'footerLogoLink' => asset('images/footer-logo.png'),
        ];
        return array_merge($returned, $data);
    }

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

    function diagnosis()
    {
        $rulebases = Rulebase::get();
        RulebaseTemp::IsOwned()->delete();
        RulebaseUserInput::IsOwned()->IsNotDone()->delete();
        FuzzyTemp::IsOwned()->delete();
        FuzzyUserInput::IsOwned()->IsNotDone()->delete();

        foreach ($rulebases as $rulebase) {
            RulebaseTemp::create([
                'user_id' => Auth::user()->id,
                'disease_id' => $rulebase->disease_id,
                'symptom_id' => $rulebase->symptom_id,
                'value' => $rulebase->value,
            ]);
        }

        $rule = array();
        $diseases = Disease::get();
        foreach ($diseases as $disease) {
            $xx = 0;
            $rule2 = array();
            $rulebases = Rulebase::where('disease_id', $disease->id)->where('value', true)->get();
            foreach ($rulebases as $rulebase) {
                array_push($rule2, $rulebase->symptom->code);
            }

            array_push($rule, $rule2);
        }

        $symptom = Symptom::where('code', $rule[0][0])->first();

        // dd($request->all(), $rulebaseTemps, $rule, $symptom);
        return Inertia::render('Diagnosing', [
            'symptom' => $symptom,
        ]);
    }

    function diagnosingPost(Request $request)
    {
        return $this->diagnosing($request);
    }

    function diagnosingPost2(Request $request)
    {
        return $this->diagnosing($request, false);
    }

    function diagnosing(Request $request, $odd = true)
    {
        $request['value'] = $request->value == "true" ? true : false;

        $cek = RulebaseUserInput::IsOwned()->IsNotDone()->where('symptom_id', $request->symptom_id)->where('value', $request->value)->get();
        if (empty($cek[0])) {
            RulebaseUserInput::create([
                'user_id' => Auth::user()->id,
                'symptom_id' => $request->symptom_id,
                'value' => $request->value == "true" ? 1 : 0,
            ]);
        }

        // if ya
        if ($request->value) {
            $diseasesArray = [];

            foreach (RulebaseTemp::IsOwned()->where('symptom_id', $request->symptom_id)->where('value', true)->get() as $key => $rulebaseTemp) {
                $diseasesArray[$key] =  $rulebaseTemp->disease_id;
            }

            // hapus yang tidak punya symptom_id -> true
            RulebaseTemp::IsOwned()->whereNotIn('disease_id', $diseasesArray)->delete();

            // hapus semua yang value false
            RulebaseTemp::IsOwned()->where('value', false)->delete();

            // dd($request->all(), $rulebaseTemps, $rule, $symptom);
            return Inertia::render('Fuzzying', $this->getViewData([
                'symptom' => Symptom::findOrFail($request->symptom_id),
                'statements' => $this->statementArray,
            ]));

            //if tidak
        } else {
            // hapus yang symptom_id true
            foreach (RulebaseTemp::IsOwned()->where('symptom_id', $request->symptom_id)->where('value', true)->get() as $key => $rulebaseTemp) {
                RulebaseTemp::IsOwned()->where('disease_id', $rulebaseTemp->disease_id)->delete();
            }

            if (RulebaseTemp::IsOwned()->get()->count() > 0) {
                $symptomArray = [];
                foreach (RulebaseUserInput::IsOwned()->IsNotDone()->get() as $key => $rulebaseUserInput) {
                    $symptomArray[$key] = $rulebaseUserInput->symptom_id;
                }

                $rulebaseTemp = RulebaseTemp::whereNotIn('symptom_id', $symptomArray)->where('value', true)->first();
                if ($rulebaseTemp) {
                    if ($odd) {
                        return Inertia::render('Diagnosing', [
                            'symptom' => $rulebaseTemp->symptom,
                        ]);
                    } else {
                        return Inertia::render('Diagnosing2', [
                            'symptom' => $rulebaseTemp->symptom,
                        ]);
                    }
                } else {
                    goto result;
                }
            } else {
                result:
                return to_route('diagnosisResult');
            }
        }
    }

    function diagnosisResult(RulebaseHistory $rulebaseHistory = null)
    {
        if (empty($rulebaseHistory)) {
            $rulebaseTemps = RulebaseTemp::isOwned()->get();

            $diseaseIds = $rulebaseTemps->pluck('disease_id')->unique();
            if ($diseaseIds->count() > 1) {
                $disease = null;
            } else {
                $disease = RulebaseTemp::IsOwned()->where('value', true)->first()?->disease;
            }

            $rulebases = $disease?->rulebases()->where('value', true)->get();

            $symptomsArray = [];
            $membershipFunctionArray = [];
            $statementsArray = $this->statementArray;

            if ($rulebases) {
                foreach ($rulebases as $rulebaseKey => $rulebase) {
                    $angka = 0.0;
                    $angka2 = 0.5;
                    $angka3 = 1.0;
                    $symptomsArray[$rulebaseKey] = $rulebase->symptom->id;
                    foreach ($statementsArray as  $statement) {
                        $membershipFunctionArray[$rulebase->symptom->id][$statement] = [$angka, $angka2, $angka3];
                        $angka = $angka + 0.5;
                        $angka2 = $angka2 + 0.5;
                        $angka3 = $angka3 + 0.5;
                    }
                }
                $fuzzyTemp = FuzzyTemp::create([
                    'user_id' => Auth::user()->id,
                    'disease_id' => $disease->id,
                    'symptom_data' => $symptomsArray,
                    'membership_data' => $membershipFunctionArray,
                ]);

                $fuzzyResult = (new FuzzyController)->doFuzzy($disease, $fuzzyTemp);
            }

            if (empty($fuzzyResult)) {
                return to_route('home');
            }

            $rulebaseHistory = RulebaseHistory::create([
                'user_id' => Auth::user()->id,
                'disease_id' => $disease->id ?? null,
                'fuzzy_value' => $fuzzyResult ?? null,
            ]);

            $rulebaseUserInputs = RulebaseUserInput::IsOwned()->IsNotDone()->with('symptom')->get();
            foreach ($rulebaseUserInputs as $key => $rulebaseUserInput) {
                $rulebaseUserInput->update([
                    'rulebase_history_id' => $rulebaseHistory->id,
                ]);
            }

            $fuzzyUserInputs = FuzzyUserInput::IsOwned()->IsNotDone()->with('symptom')->get();
            foreach ($fuzzyUserInputs as $key => $fuzzyuserInput) {
                $fuzzyuserInput->update([
                    'rulebase_history_id' => $rulebaseHistory->id,
                ]);
            }
        } else {
            $disease = $rulebaseHistory->disease;
            $rulebaseUserInputs = $rulebaseHistory->rulebaseUserInputs()->with('symptom')->get();
            $fuzzyUserInputs = $rulebaseHistory->fuzzyUserInputs()->with('symptom')->get();
        }

        // UserInput::IsOwned()->IsNotDone()->delete();
        return Inertia::render('Diagnosis', $this->getViewData([
            'disease' => $disease,
            'rulebaseUserInputs' => $rulebaseUserInputs,
            'fuzzyUserInputs' => $fuzzyUserInputs,
            'fuzzyResult' => $rulebaseHistory->fuzzy_value ? Number::percentage($rulebaseHistory->fuzzy_value, 1) : null,
        ]));
    }

    function fuzzyingPost(Request $request)
    {
        return $this->fuzzying($request);
    }

    function fuzzyingPost2(Request $request)
    {
        return $this->fuzzying($request, false);
    }

    function fuzzying(Request $request, $odd = true)
    {
        $cek = FuzzyUserInput::IsOwned()->IsNotDone()->where('symptom_id', $request->symptom_id)->where('value', $request->value)->get();
        if (empty($cek[0])) {
            FuzzyUserInput::create([
                'user_id' => Auth::user()->id,
                'symptom_id' => $request->symptom_id,
                'value' => $request->value,
            ]);
        }

        $symptomArray = [];
        foreach (RulebaseUserInput::IsOwned()->IsNotDone()->where('value', true)->get() as $key => $rulebaseUserInput) {
            $symptomArray[$key] = $rulebaseUserInput->symptom_id;
        }

        // cek apa ada yang belum di diagnosis
        $rulebaseTemp2 = RulebaseTemp::IsOwned()->whereNotIn('symptom_id', $symptomArray)->get();

        // dd($rulebaseTemp2, $symptomArray);
        if (empty($rulebaseTemp2[0])) {
            return to_route('diagnosisResult');
        } else {
            if ($odd) {
                return Inertia::render('Diagnosing', [
                    'symptom' => $rulebaseTemp2[0]->symptom,
                ]);
            } else {
                return Inertia::render('Diagnosing2', [
                    'symptom' => $rulebaseTemp2[0]->symptom,
                ]);
            }
        }
    }

    function history()
    {
        return Inertia::render('History', [
            'rulebaseHistorys' => RulebaseHistory::with('user', 'disease')->get(),
        ]);
    }
}
