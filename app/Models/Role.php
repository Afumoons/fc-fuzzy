<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\UserRole;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the userRoles that role own
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class, 'role_id', 'id');
    }
}
