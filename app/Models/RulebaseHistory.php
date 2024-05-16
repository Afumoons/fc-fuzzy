<?php

namespace App\Models;

use App\Models\User;
use App\Models\Disease;
use App\Models\UserInput;
use App\Models\FuzzyUserInput;
use App\Models\RulebaseUserInput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RulebaseHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'disease_id',
        'fuzzy_value',
    ];

    function scopeIsOwned($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    /**
     * Get the user that owns the rulebaseHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the disease that owns the rulebaseHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class, 'disease_id', 'id');
    }

    /**
     * Get the rulebaseUserInputs that owned by rulebaseHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rulebaseUserInputs(): HasMany
    {
        return $this->hasMany(RulebaseUserInput::class, 'rulebase_history_id', 'id');
    }

    /**
     * Get the fuzzyUserInputs that owned by fuzzyHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fuzzyUserInputs(): HasMany
    {
        return $this->hasMany(FuzzyUserInput::class, 'rulebase_history_id', 'id');
    }
}
