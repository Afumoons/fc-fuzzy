<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Symptom;
use App\Models\Disease;
use App\Http\Requests\UpdateSymptomRequest;
use App\Http\Requests\StoreSymptomRequest;
use App\Http\Controllers\Controller;

class SymptomController extends Controller
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
        return Inertia::render('Admin/Symptom', [
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
    public function store(StoreSymptomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSymptomRequest $request, Symptom $symptom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        //
    }
}
