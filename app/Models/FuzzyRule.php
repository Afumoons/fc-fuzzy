<?php

namespace App\Models;

use App\Models\Disease;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuzzyRule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'disease_id',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    function scopeIsOwned($query)
    {
        return $query->where('user_id', Auth::user()->id);
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
