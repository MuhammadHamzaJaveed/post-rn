<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApplicationEdit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'time',
    ];

    protected $table = 'user_application_edit';
}
