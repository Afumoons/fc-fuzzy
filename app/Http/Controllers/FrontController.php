<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Rulebase;
use App\Models\RulebaseTemp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RulebaseHistory;
use App\Models\UserInput;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

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

    function diagnosis()
    {
        $rulebases = Rulebase::get();
        RulebaseTemp::IsOwned()->delete();
        UserInput::IsOwned()->IsNotDone()->delete();

        foreach ($rulebases as $rulebase) {
            RulebaseTemp::create([
                'user_id' => Auth::user()->id,
                'disease_id' => $rulebase->disease_id,
                'symptom_id' => $rulebase->symptom_id,
                'value' => $rulebase->value,
            ]);
        }

        $no = 0;
        $rule = array();
        $diseases = Disease::get();
        foreach ($diseases as $disease) {
            $nox = $no++;
            $xx = 0;
            $disease_id = $disease->id;
            $rule2 = array();
            $rulebases = Rulebase::where('disease_id', $disease->id)->where('value', true)->get();
            foreach ($rulebases as $rulebase) {
                $xxx = $xx++;
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

        $cek = UserInput::IsOwned()->IsNotDone()->where('symptom_id', $request->symptom_id)->where('value', $request->value)->get();
        if (empty($cek[0])) {
            UserInput::create([
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

            $symptomArray = [];
            foreach (UserInput::IsOwned()->IsNotDone()->where('value', true)->get() as $key => $userInput) {
                $symptomArray[$key] = $userInput->symptom_id;
            }

            // cek apa ada yang belum di diagnosis
            $rulebaseTemp2 = RulebaseTemp::IsOwned()->whereNotIn('symptom_id', $symptomArray)->get();
            // dd($rulebaseTemp2, $symptomArray);
            if (empty($rulebaseTemp2[0])) {
                return to_route('diagnosisResult', ['disease' => true])->with('duar', true);
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

            //if tidak
        } else {
            // hapus yang symptom_id true
            foreach (RulebaseTemp::IsOwned()->where('symptom_id', $request->symptom_id)->where('value', true)->get() as $key => $rulebaseTemp) {
                RulebaseTemp::IsOwned()->where('disease_id', $rulebaseTemp->disease_id)->delete();
            }

            if (RulebaseTemp::IsOwned()->get()->count() > 0) {
                $symptomArray = [];
                foreach (UserInput::IsOwned()->IsNotDone()->get() as $key => $userInput) {
                    $symptomArray[$key] = $userInput->symptom_id;
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

            $rulebaseHistory = RulebaseHistory::create([
                'user_id' => Auth::user()->id,
                'disease_id' => $disease->id ?? null,
            ]);
            $userInputs = UserInput::IsOwned()->IsNotDone()->with('symptom')->get();
            foreach ($userInputs as $key => $userInput) {
                $userInput->update([
                    'rulebase_history_id' => $rulebaseHistory->id,
                ]);
            }
        } else {
            $disease = $rulebaseHistory->disease;
            $userInputs = $rulebaseHistory->userInputs()->with('symptom')->get();
        }

        // UserInput::IsOwned()->IsNotDone()->delete();
        return Inertia::render('Diagnosis', [
            'disease' => $disease,
            'userInputs' => $userInputs,
            'logoLink' => asset('images/logo-grey.png'),
        ]);
    }

    function history()
    {
        return Inertia::render('History', [
            'rulebaseHistorys' => RulebaseHistory::with('user', 'disease')->get(),
        ]);
    }
}
