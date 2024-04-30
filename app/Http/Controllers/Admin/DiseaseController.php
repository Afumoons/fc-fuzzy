<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Disease;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreDiseaseRequest;
use App\Http\Requests\Admin\UpdateDiseaseRequest;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diseases = Disease::get();
        return Inertia::render('Admin/Disease/Index', (new AdminController)->getViewData([
            'diseases' => $diseases,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Disease/Create', (new AdminController)->getViewData());
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
        return Inertia::render('Admin/Disease/Edit', (new AdminController)->getViewData([
            'isAdmin' => Gate::allows('isAdmin'),
            'disease' => $disease,
        ]));
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
