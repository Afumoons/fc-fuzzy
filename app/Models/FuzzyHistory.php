<?php

namespace App\Models;

use App\Models\User;
use App\Models\Disease;
use App\Models\FuzzyUserInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuzzyHistory extends Model
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
        'value',
    ];

    /**
     * Get the user that owns the fuzzyHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the disease that owns the fuzzyHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class, 'disease_id', 'id');
    }

    /**
     * Get the fuzzyUserInputs that owned by fuzzyHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fuzzyUserInputs(): HasMany
    {
        return $this->hasMany(FuzzyUserInput::class, 'fuzzy_history_id', 'id');
    }
}
