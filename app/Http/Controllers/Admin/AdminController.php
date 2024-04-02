<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Symptom;
use App\Models\Disease;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    function index()
    {
        $symptomsCount = Symptom::get()->count();
        $diseasesCount = Disease::get()->count();
        $usersCount = User::get()->count();
        $adminsCount = User::whereHas('userRoles', function ($userRoles) {
            $userRoles->where('role_id', '1');
        })->get()->count();
        $user = User::first();
        return Inertia::render('Dashboard', [
            'symptomsCount' => $symptomsCount,
            'diseasesCount' => $diseasesCount,
            'usersCount' => $usersCount,
            'adminsCount' => $adminsCount,
            'user' => $user,
            'isAdmin' => Gate::allows('isAdmin'),
        ]);
    }
}
