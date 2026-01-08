<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class AdmissionTest extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'selectedExam',
        'md_cat_cnic',
        'md_cat_obtained_marks',
        'sat_test_date',
        'sat_biology_obtained_marks',
        'sat_chemistry_obtained_marks',
        'sat_phy_math_obtained_marks',
        'sat_username',
        'sat_password',
        'ucat_test_date',
        'ucat_band',
        'ucat_obtained_marks',
        'ucat_username',
        'ucat_password',
        'mcat_obtained_marks',
        'mcat_test_date',
        'mcat_username',
        'mcat_password',
        'md_catCenter_id',
        'ucat_candidate_id',
        'mdcat_passing_year_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     *
     * @return hasOne
     */
    public function mdcatCenter(): HasOne
    {
        return $this->hasOne(MdcatCenter::class, 'id', 'md_catCenter_id');
    }

    public function mdcatPassingYear(): HasOne
    {
        return $this->hasOne(MdcatPassingYear::class, 'id', 'mdcat_passing_year_id');
    }

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'md_cat_cnic',
                'md_cat_obtained_marks',
                'sat_biology_obtained_marks',
                'sat_chemistry_obtained_marks',
                'sat_phy_math_obtained_marks',
                'ucat_band',
                'ucat_obtained_marks',
                'ucat_candidate_id',
                'mcat_obtained_marks',
                'mcat_username',
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
