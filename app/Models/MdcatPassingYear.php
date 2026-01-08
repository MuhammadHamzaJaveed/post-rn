<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdcatPassingYear extends Model
{
    use HasFactory;

    public $table = 'mdcat_passing_years';
    protected $fillable = ['name'];
}
