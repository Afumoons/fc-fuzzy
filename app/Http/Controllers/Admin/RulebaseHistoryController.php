<?php

namespace App\Http\Controllers\Admin;

use App\Models\RulebaseHistory;
use App\Http\Controllers\Controller;

class RulebaseHistoryController extends Controller
{
    public function destroy(RulebaseHistory $rulebaseHistory)
    {
        $rulebaseHistory->delete();
    }
}
