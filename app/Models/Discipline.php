<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discipline extends Model
{
    use HasFactory;
      protected $fillable = [
        'name',
        'seat_id',
        'is_active',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
