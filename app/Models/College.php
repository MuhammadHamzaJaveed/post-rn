<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class College extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'isBds',
        'district',
        'openMeritSeats',
        'overSeasSeats',
        'disabilitySeats',
        'underdevelopedAreas',
        'cholistanSeats',
        'isReciprocal',
        'isFemale',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function meritListFromCollege(): HasMany
    {
        return $this->hasMany(MeritListFromCollege::class);
    }
}
