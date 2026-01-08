<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeatCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('created_at', 'updated_at')
            ->using(SeatCategoryUser::class);
    }

    public function seatUser(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
