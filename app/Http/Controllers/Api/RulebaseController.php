<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rulebase;
use Illuminate\Http\Request;

class RulebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Rulebase::get()->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Rulebase::whereHas('disease', function ($disease) use ($id) {
            $disease->where('id', $id);
        })->get()->toArray());
    }
}
