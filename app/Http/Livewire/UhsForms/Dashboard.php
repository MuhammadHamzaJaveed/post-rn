<?php

namespace App\Http\Livewire\UhsForms;

use App\Enums\Otp\OtpReasons;
use App\Enums\Otp\OtpTypes;
use App\Jobs\ApplicationCompletedEmail;
use App\Jobs\SendOtpEmail;
use App\Models\OTPS;
use App\Models\User;
use App\Models\UserApplicationEdit;
use App\Services\MediaServices\MediaServices;
use App\Services\UserServices\UserServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use PDF;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Dashboard extends Component
{
    use WithFileUploads;

    protected $mediaServices;

    protected $userServices;

    public $image;

    public $challan;

    public $personalDetails;

    public $seatCategories = [];

    public $challanSubmitted = false;

    public $challanStatus = false;

    /**
     * @return void
     */

    /**
     * @return array
     */
    /*protected function rules(): array
    {
        return [
            'challan' => 'required',
        ];
    }*/

    /**
     * Summary of boot
     * @param  MediaServices  $mediaServices
     * @param  UserServices  $userServices
     * @return void
     */
    public function boot(MediaServices $mediaServices, UserServices $userServices)
    {
        $this->mediaServices = $mediaServices;
        $this->userServices = $userServices;
    }

    public function mount()
    {
        $user = auth()->user();
        if ($user->otps && $user->otps->is_verified == 1) {
            $user->otps->update([
                'is_verified' => 0,
            ]);
        }

        if (isset($user->image->path) && !empty($user->image->path)) {
            $this->image = Storage::disk('public')->url($user->image->path);
        }
        $this->personalDetails = $user->personalDetails;

        if ($user->userChallanImage) {
            $this->challan = $this->getImageUrl($user->userChallanImage->path);
        }

        $this->seatCategories = $user->seatCategories->pluck('id')->toArray();

        if(empty($this->challanStatus($user->challan_id)))
        {
            $this->challanStatus = false;
            auth()->user()->update([
                'transaction_id' => null,
                'is_paid' => 0,
            ]);
        }
        if (!empty($user->transaction_id) && $user->is_paid == 1) {
            $this->challanStatus = true;
        } else {
            $this->challanStatus($user->challan_id);
        }

        /*if (!empty($user->userChallanImage)) {

            if ($user->is_completed == 0 || $user->is_completed_email == 0) {
                $this->sendCompletionEmailWithPDF();
                $user->update([
                    'is_completed' => 1,
                    'is_completed_email' => 1,
                ]);
            }
        }*/

        $this->userServices->updateUser([
            'aggregate' => $this->calculateAggregate(),
            'aggregate_overseas' => $this->calculateOverseasAggregate(),

        ], auth()->user()->id);
    }

    protected $listeners = ['clearValidationError'];

    public function clearValidationError($field)
    {
        $this->resetErrorBag($field); // Clear validation error for the field
    }

    /**
     * @param $path
     * @return string
     */
    private function getImageUrl($path): string
    {
        return Storage::disk('public')->url($path);

    }

    private function calculateAggregate()
    {
        $qualifications = auth()->user()?->qualifications;
        $admissionTest = auth()->user()?->admissionTest;

        $sscObtainedMarks = $qualifications?->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications?->hssc_marks_obtained;

        $mdCatObtainedMarks = $admissionTest?->md_cat_obtained_marks;

        $programId = auth()->user()?->program_id;

        if (
            ($sscObtainedMarks && $hsscObtainedMarks) &&
            ($mdCatObtainedMarks)
        ) {
            $averageTotal = 1100;

            $ssc = $sscObtainedMarks / $qualifications?->ssc_total_marks * $averageTotal * 0.10;
            $hssc = $hsscObtainedMarks / $qualifications?->hssc_total_marks * $averageTotal * 0.40;

            $aggregation = [];

            $mdCatPercentile = $mdCatObtainedMarks / 200 * 100;

            if ((
                    ($programId == 1 || $programId == 3) && $mdCatPercentile > 55) ||
                ($programId == 2 && $mdCatPercentile > 45)
            ) {
                if ($mdCatObtainedMarks) {
                    $mdCat = $mdCatObtainedMarks / 200 * $averageTotal * 0.50;

                    $aggregation['mdCat'] = ($ssc + $hssc + $mdCat) / $averageTotal * 100;
                }
            } else {
                $aggregation['mdCat'] = 0;
            }

            $maxAggregate = max($aggregation);

            return $maxAggregate;
        } else {
            return 0;
        }
    }

    private function calculateOverseasAggregate()
    {
        $qualifications = auth()->user()?->qualifications;
        $admissionTest = auth()->user()?->admissionTest;

        $sscObtainedMarks = $qualifications?->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications?->hssc_marks_obtained;

        $mCatObtainedMarks = $admissionTest?->mcat_obtained_marks;
        $mdCatObtainedMarks = $admissionTest?->md_cat_obtained_marks;
        $uCatObtainedMarks = $admissionTest?->ucat_obtained_marks;
        $satObtainedMarks = ($admissionTest?->sat_biology_obtained_marks * 0.40) +
            ($admissionTest?->sat_chemistry_obtained_marks * 0.35) +
            ($admissionTest?->sat_phy_math_obtained_marks * 0.25);

        $programId = auth()->user()?->program_id;

        if (
            ($sscObtainedMarks && $hsscObtainedMarks) &&
            ($mdCatObtainedMarks || $uCatObtainedMarks || $satObtainedMarks || $mCatObtainedMarks)
        ) {
            $averageTotal = 1100;

            $ssc = $sscObtainedMarks / $qualifications->ssc_total_marks * $averageTotal * 0.10;
            $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;

            $aggregation = [];

            $mdCatPercentile = $mdCatObtainedMarks / 200 * 100;

            if ((
                    ($programId == 1 || $programId == 3) && $mdCatPercentile >= 55) ||
                ($programId == 2 && $mdCatPercentile >= 50)) {
                if ($mdCatObtainedMarks) {
                    $mdCat = $mdCatObtainedMarks / 200 * $averageTotal * 0.50;

                    $aggregation['mdCat'] = ($ssc + $hssc + $mdCat) / $averageTotal * 100;
                }
            } else {
                $aggregation['mdCat'] = 0;
            }

            if ($uCatObtainedMarks) {
                $uCat = $uCatObtainedMarks / 3600 * $averageTotal * 0.50;

                $aggregation['uCat'] = ($ssc + $hssc + $uCat) / $averageTotal * 100;
            }

            if ($satObtainedMarks) {
                $sat2 = $satObtainedMarks / 800 * $averageTotal * 0.50;

                $aggregation['sat2'] = ($ssc + $hssc + $sat2) / $averageTotal * 100;
            }

            if ($mCatObtainedMarks) {
                $mCat = $mCatObtainedMarks / 528 * $averageTotal * 0.50;

                $aggregation['mCat'] = ($ssc + $hssc + $mCat) / $averageTotal * 100;
            }

            $maxAggregate = max($aggregation);

            return $maxAggregate;
        } else {
            return 0;
        }
    }


    public function challan()
    {
        if (auth()->user()->challan_id) {
            $this->challanStatus(auth()->user()->challan_id);
        } else {
            $this->emit('openModal', 'uhs-forms.modal.challan-submitted-failed');
            return;
        }
        $this->userChallan();
    }

    public function redirectToOTPVerification()
    {
        $otp = $this->generateOTP();
        $userId = auth()->user()->id;
        $otpType = OtpTypes::EMAIL;
        $otpReason = OtpReasons::EDITFORM;
        // $phone_number = auth()->user()->personalDetails->mobile_number;

        // $message= "Your UHS Online Admission Portal OTP is ".$otp.". Never share this OTP with anyone. Regards UHS.";
        $this->userServices->updateOrCreateOTP($userId, $otp, $otpType, $otpReason);
        // $this->sendSms($phone_number, $message);
        dispatch(new SendOtpEmail(auth()->user()->email, $otp));

        return redirect()->route('uhs-form-otp');
    }

    public function redirectToEditForm()
    {
        return redirect()->route('uhs-form');
    }

    public function generateOTP()
    {
        return rand(1000, 9999); // Generates a 4-digit OTP
    }

    public function submit()
    {
        /*$this->validate();*/

        if (auth()->user()->challan_id) {
            $this->challanStatus(auth()->user()->challan_id);
        } else {
            /*$this->emit('openModal', 'uhs-forms.modal.challan-submitted-failed');*/
            $this->emit('showChallanModal', 'Challan Status', "Challan Form didn't found.", 'warning');
            return;
        }

        $this->userChallan();

        /*$this->emit('challanUploaded');
        $this->emit('openModal', 'uhs-forms.modal.image-submitted-successfully');*/
        /*$this->emit('$refresh');*/

        $this->emit('challanUploaded');
        /*$this->emit('openModal', 'uhs-forms.modal.image-submitted-successfully');*/
        $this->emit('showChallanModal', 'Challan Status', "Challan Form has been submitted successfully.", 'success');
        $this->emit('$refresh');
        $this->challanSubmitted = true;
    }

    /**
     * @param $image
     * @param $collection
     * @return array
     */
    private function formatImageData($image, $collection): array
    {
        return [
            'imageName' => $collection . '.' . $image->extension(),
            'imagePath' => $image->storeAs(auth()->user()->id . '_images', $collection . '.' . $image->extension(), 'public'),
            'imageSize' => $image->getSize(),
            'userId' => auth()->user()->id,
            'model' => User::class,
            'disk' => 'public',
            'collection' => $collection,
        ];
    }

    private function generateUniqueNumber(): int
    {
        $number = 42356211;

        return $number + auth()->user()->id;
    }

    /**
     * @return StreamedResponse
     */
    public function downloadChallan($type_id)
    {
        return redirect()->route('download.challan', [$type_id]);
    }

    private function challanStatus($id)
    {
        try {
            if (isset($id) && !empty($id)) {
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'content-type' => 'application/json',
                ])->get('https://fms.uhs.edu.pk/login/get_challan_status/' . base64_encode($id));

                $status = $response->getbody()->getContents();
                if ($status == 1) {
                    $this->challanStatus = true;
                    auth()->user()->update([
                        'transaction_id' => $id,
                        'is_paid' => 1,
                    ]);
                    return true;
                }
                if ($status == 0) {
                    $this->challanStatus = false;
                    return false;
                }
                return false;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function sendCompletionEmailWithPDF()
    {
        try {
            $user = auth()->user();
            if ($user->is_completed_email == 0) {
                $mbbsCollegePreferences = auth()->user()->mbbsCollegePreferences->pluck('college_pref')->toArray();
                $mbbsCollegeForeignerAsOpenMeritPreferences = auth()->user()->mbbsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();
                $bdsCollegePreferences = auth()->user()->bdsCollegePreferences->pluck('college_pref')->toArray();
                $bdsCollegeForeignerAsOpenMeritPreferences = auth()->user()->bdsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();

                $pdfData = [
                    'title' => 'Sample PDF',
                    // Challan ID and Application ID
                    'challanId' => $user?->challan_id,
                    'applicationId' => $user?->id,
                    'seatCategory' => $user?->seatCategories?->pluck('id')?->toArray(),
                    // Personal Information
                    'cnic' => $user?->personalDetails?->cnic_passport,
                    'name' => $user?->name,
                    'foreigner' => $user?->foreigner,
                    'fatherName' => $user?->father_name,
                    'motherName' => $user?->personalDetails?->mother_name,
                    'gender' => $user?->personalDetails?->gender?->name,
                    'nationality' => $user?->personalDetails?->nationality?->name,
                    'country' => $user?->personalDetails?->country,
                    'dateOfBirth' => $user?->personalDetails?->date_of_birth,
                    'districtOfDomicile' => $user?->personalDetails?->district?->name,
                    'areaOfResidence' => $user?->personalDetails?->area?->name,
                    'mailingAddress' => $user?->personalDetails?->address,
                    'telephone' => $user?->personalDetails?->telephone_number,
                    'secondaryNumber' => $user?->personalDetails?->secondary_number,
                    'phoneNumber' => $user?->personalDetails?->mobile_number,
                    'email' => $user?->email,
                    // Qualifications Section
                    'sscExam' => $user?->qualifications?->sscExam?->name,
                    'hsscExam' => $user?->qualifications->hsscExam?->name,
                    'sscSubjects' => $user?->qualifications?->ssc_science_subjects,
                    'hsscSubjects' => $user?->qualifications?->hssc_science_subjects,
                    'sscInstitution' => $user?->qualifications?->sscInstitution->name,
                    'hsscInstitution' => $user?->qualifications?->hsscInstitution->name,
                    'sscBoard' => $user?->qualifications?->sscBoard?->name,
                    'sscRollNumber' => $user?->qualifications?->ssc_roll_no,
                    'hsscRollNumber' => $user?->qualifications?->hssc_roll_no,
                    'hsscBoard' => $user?->qualifications?->hsscBoard?->name,
                    'sccPassingYear' => $user?->qualifications?->ssc_passing_year,
                    'hsccPassingYear' => $user?->qualifications?->hssc_passing_year,
                    'sscMarks' => $user?->qualifications?->ssc_marks_obtained,
                    'hsscMarks' => $user?->qualifications?->hssc_marks_obtained,
                    'sscTotalMarks' => $user?->qualifications?->ssc_total_marks,
                    'hsscTotalMarks' => $user?->qualifications?->hssc_total_marks,
                    'physics' => $user?->qualifications?->physics_score,
                    'chemistry' => $user?->qualifications?->chemistry_score,
                    'biology' => $user?->qualifications?->biology_score,
                    'physicsTotal' => $user?->qualifications?->physics_total_score,
                    'chemistryTotal' => $user?->qualifications?->chemistry_total_score,
                    'biologyTotal' => $user?->qualifications?->biology_total_score,
                    // Programs Name
                    'programs' => $user->program->name,
                    // Seats Category
                    'seats' => implode(', ', $user->seatCategories->pluck('name')->toArray()),
                    //Aggregate
                    'aggregate' => $user->aggregate,
                    'aggregate_overseas' => $user->aggregate_overseas !== null ? $user->aggregate_overseas : null,
                    //MDACT INFORMATION
                    'mdcatCnic' => $user->admissionTest->md_cat_cnic,
                    'mdcatCenter' => optional($user->admissionTest->mdcatCenter)->name ?? 'N/A',
                    'mdcatMarks' => $user->admissionTest->md_cat_obtained_marks,
                    'mdcatApplicantCnic' => $user->personalDetails->cnic_passport,
                    'mdcatPassingYear' => $user?->admissionTest?->mdcatPassingYear?->name,
                    //SAT INFORMATION
                    'satTestDate' => $user?->admissionTest?->sat_test_date,
                    'satBiologyMarks' => $user?->admissionTest?->sat_biology_obtained_marks,
                    'satChemistryMarks' => $user?->admissionTest?->sat_chemistry_obtained_marks,
                    'satPhyMathMarks' => $user?->admissionTest?->sat_phy_math_obtained_marks,
                    'satUserName' => $user?->admissionTest?->sat_username,
                    'satPassword' => $user?->admissionTest?->sat_password,
                    //UCAT INFORMATION
                    'ucatId' => $user?->admissionTest?->ucat_candidate_id,
                    'ucatTestDate' => $user?->admissionTest?->ucat_test_date,
                    'ucatObtainedMarks' => $user?->admissionTest?->ucat_obtained_marks,
                    'ucatBandScore' => $user?->admissionTest?->ucat_band,
                    // MCAT INFORMATION
                    'mcatTestDate' => $user?->admissionTest?->mcat_test_date,
                    'mcatObtaniedMarks' => $user?->admissionTest?->mcat_obtained_marks,
                    'mcatUserName' => $user?->admissionTest?->mcat_username,
                    'mcatPassword' => $user?->admissionTest?->mcat_password,
                    //College Preferences
                    'mbbsPreference' => !empty($mbbsCollegePreferences) ? json_decode($mbbsCollegePreferences[0], true) : [],
                    'bdsPreference' => !empty($bdsCollegePreferences) ? json_decode($bdsCollegePreferences[0], true) : [],
                    'mbbsForeignAsOpenMeritPreference' => !empty($mbbsCollegeForeignerAsOpenMeritPreferences) ? json_decode($mbbsCollegeForeignerAsOpenMeritPreferences[0], true) : [],
                    'bdsForeignAsOpenMeritPreference' => !empty($bdsCollegeForeignerAsOpenMeritPreferences) ? json_decode($bdsCollegeForeignerAsOpenMeritPreferences[0], true) : [],
                    'image_pages' => false,
                ];

                $pdfContent = PDF::loadView('livewire.pdf.myApplication', $pdfData, ['satCnic'])->output();

                dispatch(new ApplicationCompletedEmail($user->email, base64_encode($pdfContent)));
            }
        } catch (\Exception $e) {
            dd($e->getMessage(),
            $e->getFile(),
            $e->getLine());

        }
    }

    public function finalSubmit()
    {
        try {
            $user = auth()->user();
            if (!empty($user->userChallanImage)) {
                if($user->is_paid == 1 && !empty($user->transaction_id))
                {
                    if ($user->is_completed == 0 || $user->is_completed_email == 0) {
                        $this->sendCompletionEmailWithPDF();
                        $user->update([
                            'is_completed' => 1,
                            'is_completed_email' => 1,
                        ]);
                        UserApplicationEdit::create([
                            'user_id' => $user->id,
                            'action' => 'final_submit',
                            'time' => Carbon::now(),
                        ]);

                        $this->emit('finalSubmit');
                        $this->emit('showChallanModal', 'Application Status', "Application Submitted Successfully.", 'success');
                        $this->emit('$refresh');
                    }
                }
                else
                {
                    /*$this->emit('openModal', 'uhs-forms.modal.challan-status-unpaid');*/
                    $this->emit('showChallanModal', 'Challan Status', 'Challan Status is unpaid.', 'error');
                return;
                }
            }
            else
            {
                /*$this->emit('openModal', 'uhs-forms.modal.challan-submitted-failed');*/
                $this->emit('showChallanModal', 'Challan Status', "Challan Form didn't found.", 'warning');
                return;
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function userChallan(): void
    {
        if (empty(auth()->user()->userChallanImage) && empty($this->challan))
        {
            $this->validate([
                'challan' => 'required',
            ]);
        }

        if (!is_string($this->challan)  && $this->challan) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userChallanImage?->id,
            ], $this->formatImageData($this->challan, 'userChallanImage'));
            $this->resetErrorBag('challan');
            $this->challan = null;
        }
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('livewire.uhs-forms.dashboard')
            ->extends('layouts.uhs-form')
            ->section('content');
    }
}
