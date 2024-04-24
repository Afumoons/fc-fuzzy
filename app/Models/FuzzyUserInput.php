<?php

namespace App\Models;

use App\Models\User;
use App\Models\Symptom;
use App\Models\FuzzyHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuzzyUserInput extends Model
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
        'fuzzy_history_id',
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
        return $query->where('fuzzy_history_id', null);
    }

    /**
     * Get the user that owns the fuzzyUserInput
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the symptom that owns the fuzzyUserInput
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class, 'symptom_id', 'id');
    }

    /**
     * Get the fuzzyHistory that owns the fuzzyUserInput
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fuzzyHistory(): BelongsTo
    {
        return $this->belongsTo(FuzzyHistory::class, 'fuzzy_history_id', 'id');
    }
}
