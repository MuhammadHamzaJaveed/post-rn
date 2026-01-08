<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SelectionList extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'selection_lists';

    protected $fillable = [
        'name',
        'status',
    ];

    public function meritListFromCollege(): HasMany
    {
        return $this->hasMany(MeritListFromCollege::class);
    }

}
