<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\RulebaseHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function getViewData(array $data = [])
    {
        $returned = [
            'isAdmin' => Gate::allows('isAdmin'),
            'logo' => asset('images/logo.png'),
        ];
        return array_merge($returned, $data);
    }

    function index()
    {
        $symptomsCount = Symptom::get()->count();
        $diseasesCount = Disease::get()->count();
        $usersCount = User::get()->count();
        $adminsCount = User::whereHas('userRoles', function ($userRoles) {
            $userRoles->where('role_id', '1');
        })->get()->count();
        $dashboardCounts = (object)[
            'symptomsCount' => $symptomsCount,
            'diseasesCount' => $diseasesCount,
            'usersCount' => $usersCount,
            'adminsCount' => $adminsCount,
        ];
        return Inertia::render('Dashboard', $this->getViewData([
            'dashboardCounts' => $dashboardCounts,
            'rulebaseHistorys' => RulebaseHistory::IsOwned()->with('user', 'disease')->get(),
        ]));
    }
}
