<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Symptom;
use App\Http\Requests\Admin\UpdateSymptomRequest;
use App\Http\Requests\Admin\StoreSymptomRequest;
use App\Http\Controllers\Controller;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $symptoms = Symptom::get();
        return Inertia::render('Admin/Symptom/Index', [
            'symptoms' => $symptoms,
            'isAdmin' => Gate::allows('isAdmin'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Symptom/Create', [
            'isAdmin' => Gate::allows('isAdmin'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSymptomRequest $request)
    {
        $validatedData = $request->validated();
        Symptom::create($validatedData);

        return to_route('admin.symptom.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom)
    {
        return Inertia::render('Admin/Symptom/Edit', [
            'isAdmin' => Gate::allows('isAdmin'),
            'symptom' => $symptom,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSymptomRequest $request, Symptom $symptom)
    {
        $validatedData = $request->validated();
        $symptom->update($validatedData);

        return to_route('admin.symptom.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
    }
}
