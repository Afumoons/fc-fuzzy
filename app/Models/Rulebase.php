<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Symptom;
use App\Models\Disease;

class Rulebase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'disease_id',
        'symptom_id',
        'value',
    ];

    protected $casts = [
        'value' => 'boolean',
    ];

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
