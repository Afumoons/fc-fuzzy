<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Rulebase;

class Disease extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'cause',
        'solution',
    ];

    /**
     * Get the rulebases that disease own
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rulebases(): HasMany
    {
        return $this->hasMany(Rulebase::class, 'disease_id', 'id');
    }
}
