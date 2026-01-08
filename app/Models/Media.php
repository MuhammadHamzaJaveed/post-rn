<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'mediaable_type',
        'mediaable_id',
        'name',
        'path',
        'disk',
        'size',
        'collection'
    ];

     /**
     * Get the parent imageable model (user or post).
     */
    public function mediaable(): MorphTo
    {
        return $this->morphTo();
    }
}

