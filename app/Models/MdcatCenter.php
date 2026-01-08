<?php

namespace App\Models;

use App\Http\Livewire\UhsForms\Steps\AdmissionTest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MdcatCenter extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return BelongsTo
     */

     public function admissionTest(): BelongsTo
    {
        return $this->belongsTo(AdmissionTest::class);
    }
}
