<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Symptom;
use App\Models\Disease;
use App\Http\Requests\Admin\UpdateDiseaseRequest;
use App\Http\Requests\Admin\StoreDiseaseRequest;
use App\Http\Controllers\Controller;
use Inertia\Response;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diseases = Disease::get();
        return Inertia::render('Admin/Disease/Index', [
            'diseases' => $diseases,
            'isAdmin' => Gate::allows('isAdmin'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Disease/Create', [
            'isAdmin' => Gate::allows('isAdmin'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiseaseRequest $request)
    {
        $validatedData = $request->validated();
        Disease::create($validatedData);

        return to_route('admin.disease.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disease $disease)
    {
        return Inertia::render('Admin/Disease/Edit', [
            'isAdmin' => Gate::allows('isAdmin'),
            'disease' => $disease,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiseaseRequest $request, Disease $disease)
    {
        $validatedData = $request->validated();
        $disease->update($validatedData);

        return to_route('admin.disease.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disease $disease)
    {
        $disease->delete();
    }
}
