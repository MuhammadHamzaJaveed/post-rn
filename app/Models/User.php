<?php

namespace App\Models;

use App\Jobs\QueuedPasswordResetJob;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $father_name
 * @property string $dob
 * @property string $department
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class User extends Authenticatable implements CanResetPassword, FilamentUser, MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasRoles;

    use HasFactory, LogsActivity;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'plain_password',
        'father_name',
        'mobile_number',
        'transaction_id',
        'amount',
        'challan_amount',
        'branch_code',
        'branch_name',
        'challan_id',
        'challan_amount',
        'program_id',
        'college_preference_id',
        'accepted_terms_and_conditions',
        'program_priority',
        'aggregate',
        'affirmation',
        'aggregate_overseas',
        'status',
        'edit_user_status',
        'verification_user_status',
        'comments',
        'submitted_at',
        'is_paid',
        'foreigner',
        'cnic_passport',
        'cnic_passport_id',
        'is_completed',
        'is_completed_email',
        'updated_at',
        'is_open_merit',
        'seat_id',
        'admission_is_paid',
        'selection_seat_id',
        'discipline_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * For Production apply access check for admin panel
     */
    public function canAccessFilament(): bool
    {
        $roles = [
            config('role_names.roles.super_admin'),
            config('role_names.roles.admin'),
            config('role_names.roles.incharge-team'),
            config('role_names.roles.verification-team'),
            config('role_names.roles.supervisory-team'),
            config('role_names.roles.college'),
        ];

        return $this->hasRole($roles) || $this->email == 'adminbig@uhs.com' || $this->email == 'adminImageUpload@uhs.com';
    }

    // make attribute isSuperAdmin
    public function getIsSuperAdminAttribute(): bool
    {
        return $this->hasRole(config('role_names.roles.super_admin'));
    }
    // make attribute isAdmin
    public function getIsAdminAttribute(): bool
    {
        return $this->hasRole(config('role_names.roles.admin'));
    }
    public function image(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'avatar');
    }

    public function userCnic(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userCnic');
    }

    public function userCnicBackSide(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userCnicBackSide');
    }

    public function userChallanImage(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userChallanImage');
    }

    public function userFatherCnic(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userFatherCnic');
    }

    public function userFatherCnicAffidavit(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userFatherCnicAffidavit');
    }

    public function userFatherCnicBackSide(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userFatherCnicBackSide');
    }

    public function userSignatureImage(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'signature');
    }

    public function userColorPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userColorPhoto');
    }

    public function userDisabilityPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDisabilityPhoto');
    }

    public function userDisabilitySecondPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDisabilitySecondPhoto');
    }

    public function userSchoolLeavingPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userSchoolLeavingPhoto');
    }

    public function userProvisionalCertificatePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userProvisionalCertificatePhoto');
    }

    public function userUnderDevelopedFirstPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userUnderDevelopedFirstPhoto');
    }

    public function userUnderDevelopedSecondPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userUnderDevelopedSecondPhoto');
    }

    public function userUnderDevelopedThirdPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userUnderDevelopedThirdPhoto');
    }

    public function userCholistanCertificatePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userCholistanCertificatePhoto');
    }

    public function userCholistanCertificateSecondPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userCholistanCertificateSecondPhoto');
    }

    public function userStayCardPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userStayCardPhoto');
    }

    public function userForeignHsscCertificatePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userForeignHsscCertificatePhoto');
    }

    public function userIntermediateTranscriptPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userIntermediateTranscriptPhoto');
    }

    public function userEquivalenceSscPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userEquivalenceSscPhoto');
    }

    public function userEquivalenceHsscPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userEquivalenceHsscPhoto');
    }

    public function userIntermediateTranscriptBackSidePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userIntermediateTranscriptBackSidePhoto');
    }

    public function userVerifiedByCeoPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userVerifiedByCeoPhoto');
    }

    public function userDomicileCertificatePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDomicileCertificatePhoto');
    }

    public function userMdcatResultCardPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userMdcatResultCardPhoto');
    }

    public function userMatricTranscriptPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userMatricTranscriptPhoto');
    }

    public function userMatricTranscriptBackSidePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userMatricTranscriptBackSidePhoto');
    }

    //Extra Docs

    public function userDocumentRequirementOnePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementOnePhoto');
    }

    public function userDocumentRequirementTwoPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementTwoPhoto');
    }

    public function userDocumentRequirementThreePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementThreePhoto');
    }

    public function userDocumentRequirementFourPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementFourPhoto');
    }

    public function userDocumentRequirementFivePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementFivePhoto');
    }

    public function userDocumentRequirementSixPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementSixPhoto');
    }

    public function userDocumentRequirementSevenPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementSevenPhoto');
    }

    public function userDocumentRequirementEightPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementEightPhoto');
    }

    public function userDocumentRequirementNinePhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementNinePhoto');
    }

    public function userDocumentRequirementTenPhoto(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userDocumentRequirementTenPhoto');
    }

    public function userAdmissionChallanImage(): MorphOne
    {
        return $this
            ->morphOne(Media::class, 'mediaable')
            ->where('collection', 'userAdmissionChallanImage');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function mbbsCollegePreferences(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('is_mbbs', 1);
    }

    public function mbbsCollegeForeignerAsOpenMeritPreferences(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('is_mbbs', 1)->where('is_open_merit_seat', 1);
    }

    public function mbbsCollegeForeigner(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('is_mbbs', 1)
            ->where('is_foreigner', 1);
    }

    public function bdsCollegeOpenForeigner(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('is_mbbs', 0)
            ->where('is_foreigner', 1)
            ->where('is_open_merit_seat', 1);
    }

    public function bdsCollegePreferences(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('is_mbbs', 0);
    }

    public function bdsCollegeForeignerAsOpenMeritPreferences(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('is_mbbs', 0)->where('is_open_merit_seat', 1);
    }


    public function morningCollegePreferences(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('both_seat', 0);
    }

    public function eveningCollegePreferences(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('both_seat', 0)->where('is_evening', 1);
    }


    public function morningEveningCollegePreferences(): HasMany
    {
        return $this->hasMany(CollegePreference::class)->where('both_seat', 1)->where('is_evening', 1);
    }


    /**
     * @return HasOne
     */
    public function personalDetails(): HasOne
    {
        return $this->hasOne(PersonalDetail::class);
    }

    /**
     * @return HasOne
     */
    public function qualifications(): HasOne
    {
        return $this->hasOne(Qualification::class);
    }

    /**
     * @return HasOne
     */
    public function examPassed(): HasOne
    {
        return $this->hasOne(ExamPassed::class);
    }

    /**
     * @return HasOne
     */
    public function institutionType(): HasOne
    {
        return $this->hasOne(InstitutionType::class);
    }

    /**
     * @return HasOne
     */
    public function admissionTest(): HasOne
    {
        return $this->hasOne(AdmissionTest::class);
    }

    /**
     * @return BelongsToMany
     */
    public function seatCategories(): BelongsToMany
    {
        return $this->belongsToMany(SeatCategory::class)
            ->withPivot('created_at', 'updated_at')
            ->using(SeatCategoryUser::class);
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    public function sendPasswordResetNotification($token)
    {
        QueuedPasswordResetJob::dispatch($this, $token);
    }

    public function otps(): HasOne
    {
        return $this->hasOne(OTPS::class);
    }

    public function user_application_edit(): HasMany
    {
        return $this->hasMany(UserApplicationEdit::class);
    }

    /*public function logs()
    {
    return $this->hasMany(Activity::class, 'subject_id');
    }*/

    public function fullMedia()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function cnicPassport(): BelongsTo
    {
        return $this->belongsTo(cnicPassport::class);
    }
    public function meritListFromCollege(): HasMany
    {
        return $this->hasMany(MeritListFromCollege::class);
    }

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'email',
                'father_name',
                'mobile_number',
                'challan_id',
                'amount',
                'program_id',
                'program_priority',
                'aggregate',
                'aggregate_overseas',
                'comments',
                'affirmation',
                'status',
            ])
            ->logOnlyDirty()
            ->setDescriptionForEvent(function (string $eventName) {
                return match ($eventName) {
                    'updated' => $this->id . ' has been updated by user id: ' . auth()->user()?->id . ' and email ' . auth()->user()?->email,
                    'deleted' => $this->id . ' has been deleted by user id: ' . auth()->user()?->id . ' and email ' . auth()->user()?->email,
//                   'created' => $this->id.' has been created by user id: '.auth()->user()->id.' and email '.auth()->user()->email,
                    default => 'User information unknown',
                };
            });
    }
}
