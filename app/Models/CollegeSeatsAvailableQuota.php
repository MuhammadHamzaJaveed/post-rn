<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CollegeSeatsAvailableQuota extends Model

{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'meritlist_id',
        'college_id',
        'openMeritSeats',
        'overSeasSeats',
        'disabilitySeats',
        'cholistanSeats',
        'isReciprocal',
        'underDevelopArea',
        
    ];

    public function colleges(): HasMany
    {
        return $this->hasMany(College::class);
        return $this->hasMany(MeritList::class);
    }
}
