<?php

namespace App\Models;

use App\Models\User;
use App\Models\Symptom;
use App\Models\RulebaseHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInput extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'symptom_id',
        'rulebase_history_id',
        'value',
    ];

    protected $casts = [
        'value' => 'boolean',
    ];

    function scopeIsOwned($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    function scopeIsNotDone($query)
    {
        return $query->where('rulebase_history_id', null);
    }

    /**
     * Get the symptom that owns the rulebase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the symptom that owns the rulebase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class, 'symptom_id', 'id');
    }

    /**
     * Get the symptom that owns the rulebase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rulebaseHistory(): BelongsTo
    {
        return $this->belongsTo(RulebaseHistory::class, 'rulebase_history_id', 'id');
    }
}
