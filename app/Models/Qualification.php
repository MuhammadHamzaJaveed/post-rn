<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Qualification extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'ssc_exam_passeds_id',
        'ssc_science_subjects',
        'ssc_institution_id',
        'hssc_institution_id',
        'ssc_passing_year',
        'ssc_marks_obtained',
        'ssc_total_marks',
        'ssc_roll_no',
        'hssc_exam_passeds_id',
        'hssc_science_subjects',
        'hssc_institution_id',
        'hssc_passing_year',
        'hssc_marks_obtained',
        'hssc_total_marks',
        'hssc_roll_no',
        'ssc_board_id',
        'hssc_board_id',
        'second_Db',
        'physics',
        'biology',
        'chemistery',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
     /**
     * @return HasOne
     */
    public function boards(): HasOne
    {
        return $this->hasOne(Boards::class);
    }

    /**
     * @return HasOne
     */
    public function sscExam(): HasOne
    {
        return $this->hasOne(SscExamPassed::class, 'id', 'ssc_exam_passeds_id');
    }

    /**
     * @return HasOne
     */
    public function hsscExam(): HasOne
    {
        return $this->hasOne(ExamPassed::class, 'id', 'hssc_exam_passeds_id');
    }

    /**
     * @return HasOne
     */
    public function hsscInstitution(): HasOne
    {
        return $this->hasOne(InstitutionType::class, 'id', 'hssc_institution_id');
    }

    /**
     * @return HasOne
     */
    public function sscInstitution(): HasOne
    {
        return $this->hasOne(InstitutionType::class, 'id', 'ssc_institution_id');
    }

    /**
     * @return HasOne
     */
    public function sscBoard(): HasOne
    {
        return $this->hasOne(Boards::class, 'id', 'ssc_board_id');
    }

    /**
     * @return HasOne
     */
    public function hsscBoard(): HasOne
    {
        return $this->hasOne(Boards::class, 'id', 'hssc_board_id');
    }
    public function institutiontype(): HasOne
    {
        return $this->hasOne(InstitutionType::class);
    }
    
    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'ssc_science_subjects',
                'ssc_marks_obtained',
                'ssc_passing_year',
                'ssc_total_marks',
                'hssc_passing_year',
                'hssc_marks_obtained',
                'hssc_total_marks',
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
