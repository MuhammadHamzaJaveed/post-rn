<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PersonalDetail extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'mother_name',
        'date_of_birth',
        'mobile_number',
        'telephone_number',
        'email',
        'gender_id',
        'residence_area_id',
        'address',
        'district_id',
        'nationality_id',
        'secondary_number',
        'country',
        'city',
        'cnic_passport',
        'cnic_passport_id',
    ];

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
    public function cnicPassport(): BelongsTo
    {
        return $this->belongsTo(cnicPassport::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(ResidenceArea::class, 'residence_area_id', 'id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'mother_name',
                'date_of_birth',
                'telephone_number',
                'gender_id',
                'cnic_passport',
                'district_id',
                'nationality_id',
            ])
            ->logOnlyDirty()
            ->setDescriptionForEvent(function (string $eventName) {
                return match ($eventName) {
                    'updated' => $this->user_id.' has been updated by user id: '.auth()->user()->id.' and email '.auth()->user()->email,
                    'deleted' => $this->user_id.' has been deleted by user id: '.auth()->user()->id.' and email '.auth()->user()->email,
                    'created' => $this->user_id.' has been created by user id: '.auth()->user()->id.' and email '.auth()->user()->email,
                    default => 'User information unknown',
                };
            });
    }
}
