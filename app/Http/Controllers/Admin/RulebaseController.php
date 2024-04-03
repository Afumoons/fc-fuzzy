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
        $symptomsCount = Symptom::get()->count();
        $diseasesCount = Disease::get()->count();
        $usersCount = User::get()->count();
        $adminsCount = User::whereHas('userRoles', function ($userRoles) {
            $userRoles->where('role_id', '1');
        })->get()->count();
        $user = User::first();
        return Inertia::render('Admin/Rulebase/Index', [
            'symptomsCount' => $symptomsCount,
            'diseasesCount' => $diseasesCount,
            'usersCount' => $usersCount,
            'adminsCount' => $adminsCount,
            'user' => $user,
            'isAdmin' => Gate::allows('isAdmin'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRulebaseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rulebase $rulebase)
    {
        //
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
