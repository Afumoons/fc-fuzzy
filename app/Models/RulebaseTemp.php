<?php

namespace App\Models;

use App\Models\User;
use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RulebaseTemp extends Model
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
        'symptom_id',
        'value',
    ];

    protected $casts = [
        'value' => 'boolean',
    ];

    function scopeIsOwned($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    /**
     * Get the user that owns the rulebase
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
     * Get the disease that owns the rulebase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class, 'disease_id', 'id');
    }
}
