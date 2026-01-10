<?php

namespace App\Http\Livewire\UhsForms;

use App\Helpers\MediaHelper;
use Livewire\Component;
use App\Models\User;
use App\Services\MediaServices\MediaServices;
use App\Services\UserServices\UserServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use PDF;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;

class ApplicationStatus extends Component
{
    use WithFileUploads;

    public $cnic;

    public $fatherCnic;

    public $signature;

    public $photo;

    public $disability;

    public $schoolLeaving;

    public $cholistanCertificate;

    public $stayCard;

    public $intermediateTranscript;

    public $verifiedByCeo;

    public $domicileCertificate;

    public $mdcatResultCard;

    public $matricTranscript;

    public $personalDetails;

    public $qualifications;

    public $admissionTest;

    public $mdcatCenters;

    public $seatCategory;

    public $program; 

    protected $mediaServices;

    protected $userServices;

    public $mbbsPreference;

    public $mbbsForeignAsOpenMeritPreference;

    public $bdsPreference;

    public $morningPreference;

    public $eveningPreference;


    public $morningEveningPreference;

    public $image;

    public $challan;

    public $seatCategories = [];

    public $matricTranscriptBackSide;

    public $equivalenceCertificateSsc;

    public $intermediateTranscriptBackSide;

    public $equivalenceCertificateHssc;

    public $cnicBackSide;

    public $fatherCnicBackSide;

    //under developed data
    public $provisionalCertificate;

    public $underDevelopedExtra1;
    
    public $underDevelopedExtra2;

    public $underDevelopedExtra3;
    
    //cholistan

    public $cholistanCertificateSecond;

    public $disabilitySecond;

    public $foreignHsscCertificate;

    // Extra Documents Requirements
    public $extraDocRequire1;

    public $extraDocRequire2;

    public $extraDocRequire3;

    public $extraDocRequire4;

    public $extraDocRequire5;

    public $extraDocRequire6;

    public $extraDocRequire7;

    public $extraDocRequire8;

    public $extraDocRequire9;

    public $extraDocRequire10;

    public $pdfData = [];

    public $userImage;

    public $foreigner;

    public $experiences;

    public function mount()
    {
        $user = auth()->user();
        if (auth()->user()->otps && auth()->user()->otps->is_verified == 1) {
            auth()->user()->otps->update([
                'is_verified' => 0,
            ]);
        }
               
        
        // $abort = ! blank(auth()->user()->bdsCollegePreferences) || ! blank(auth()->user()->mbbsCollegePreferences);
        // abort_if(! $abort, 404);
        $this->foreigner = auth()?->user()?->foreigner;
        $this->personalDetails = auth()->user()->personalDetails;
        $this->qualifications = auth()->user()->qualifications;
        $this->admissionTest = auth()->user()->admissionTest;
        $this->program = auth()->user()->program;
        /*$mbbsCollegePreferences = auth()->user()->mbbsCollegePreferences->pluck('college_pref')->toArray();
        $this->mbbsPreference = !empty($mbbsCollegePreferences) ? json_decode($mbbsCollegePreferences[0], true) : [];*/

        /*$mbbsCollegeForeignerAsOpenMeritPreferences = auth()->user()->mbbsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();
        $this->mbbsForeignAsOpenMeritPreference = !empty($mbbsCollegeForeignerAsOpenMeritPreferences) ? json_decode($mbbsCollegeForeignerAsOpenMeritPreferences[0], true) : [];*/
        
        /*$bdsCollegePreferences = auth()->user()->bdsCollegePreferences->pluck('college_pref')->toArray();
        $this->bdsPreference = !empty($bdsCollegePreferences) ? json_decode($bdsCollegePreferences[0], true) : [];*/

        $morningCollegePreferences = auth()->user()->morningCollegePreferences->pluck('college_pref')->toArray();
        $this->morningPreference = !empty($morningCollegePreferences) ? json_decode($morningCollegePreferences[0], true) : [];
       /* $bdsCollegeForeignerAsOpenMeritPreferences = auth()->user()->bdsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();
        $this->bdsForeignAsOpenMeritPreference = !empty($bdsCollegeForeignerAsOpenMeritPreferences) ? json_decode($bdsCollegeForeignerAsOpenMeritPreferences[0], true) : [];*/


        $eveningCollegePreferences = auth()->user()->eveningCollegePreferences->pluck('college_pref')->toArray();
        $this->eveningPreference = !empty($eveningCollegePreferences) ? json_decode($eveningCollegePreferences[0], true) : [];

        $morningEveningCollegePreferences = auth()->user()->morningEveningCollegePreferences->pluck('college_pref')->toArray();
        $this->morningEveningPreference = !empty($morningEveningCollegePreferences) ? json_decode($morningEveningCollegePreferences[0], true) : [];

        $this->seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();

        $this->experiences = collect(json_decode($this->qualifications->experiences,true));

        $user = auth()->user();

        if ($user->userCnic) {
            $this->cnic = $this->getImageUrl($user->userCnic->path);
        }

        if ($user->userFatherCnic) {
            $this->fatherCnic = $this->getImageUrl($user->userFatherCnic->path);
        }

        if ($user->userSignatureImage) {
            $this->signature = $this->getImageUrl($user->userSignatureImage->path);
        }

        if ($user->userColorPhoto) {
            $this->photo = $this->getImageUrl($user->userColorPhoto->path);
        }

        if ($user->userDisabilityPhoto) {
            $this->disability = $this->getImageUrl($user->userDisabilityPhoto->path);
        }

        if ($user->userSchoolLeavingPhoto) {
            $this->schoolLeaving = $this->getImageUrl($user->userSchoolLeavingPhoto->path);
        }

        if ($user->userCholistanCertificatePhoto) {
            $this->cholistanCertificate = $this->getImageUrl($user->userCholistanCertificatePhoto->path);
        }

        if ($user->userStayCardPhoto) {
            $this->stayCard = $this->getImageUrl($user->userStayCardPhoto->path);
        }

        if ($user->userIntermediateTranscriptPhoto) {
            $this->intermediateTranscript = $this->getImageUrl($user->userIntermediateTranscriptPhoto->path);
        }

        if ($user->userVerifiedByCeoPhoto) {
            $this->verifiedByCeo = $this->getImageUrl($user->userVerifiedByCeoPhoto->path);
        }

        if ($user->userDomicileCertificatePhoto) {
            $this->domicileCertificate = $this->getImageUrl($user->userDomicileCertificatePhoto->path);
        }

        if ($user->userMdcatResultCardPhoto) {
            $this->mdcatResultCard = $this->getImageUrl($user->userMdcatResultCardPhoto->path);
        }

        if ($user->userMatricTranscriptPhoto) {
            $this->matricTranscript = $this->getImageUrl($user->userMatricTranscriptPhoto->path);
        }

        if ($user->userCnicBackSide) {
            $this->cnicBackSide = $this->getImageUrl($user->userCnicBackSide->path);
        }

        if ($user->userFatherCnicBackSide) {
            $this->fatherCnicBackSide = $this->getImageUrl($user->userFatherCnicBackSide->path);
        }

        if ($user->userDisabilitySecondPhoto) {
            $this->disabilitySecond = $this->getImageUrl($user->userDisabilitySecondPhoto->path);
        }

        if ($user->userProvisionalCertificatePhoto) {
            $this->provisionalCertificate = $this->getImageUrl($user->userProvisionalCertificatePhoto->path);
        }

        if ($user->userUnderDevelopedFirstPhoto) {
            $this->underDevelopedExtra1 = $this->getImageUrl($user->userUnderDevelopedFirstPhoto->path);
        }

        if ($user->userUnderDevelopedSecondPhoto) {
            $this->underDevelopedExtra2 = $this->getImageUrl($user->userUnderDevelopedSecondPhoto->path);
        }

        if ($user->userUnderDevelopedThirdPhoto) {
            $this->underDevelopedExtra3 = $this->getImageUrl($user->userUnderDevelopedThirdPhoto->path);
        }

        if ($user->userCholistanCertificateSecondPhoto) {
            $this->cholistanCertificateSecond = $this->getImageUrl($user->userCholistanCertificateSecondPhoto->path);
        }

        if ($user->userForeignHsscCertificatePhoto) {
            $this->foreignHsscCertificate = $this->getImageUrl($user->userForeignHsscCertificatePhoto->path);
        }

        if ($user->userIntermediateTranscriptBackSidePhoto) {
            $this->intermediateTranscriptBackSide = $this->getImageUrl($user->userIntermediateTranscriptBackSidePhoto->path);
        }

        if ($user->userMatricTranscriptBackSidePhoto) {
            $this->matricTranscriptBackSide = $this->getImageUrl($user->userMatricTranscriptBackSidePhoto->path);
        }

        if ($user->userEquivalenceSscPhoto) {
            $this->equivalenceCertificateSsc = $this->getImageUrl($user->userEquivalenceSscPhoto->path);
        }

        if ($user->userEquivalenceHsscPhoto) {
            $this->equivalenceCertificateHssc = $this->getImageUrl($user->userEquivalenceHsscPhoto->path);
        }

        // Extra Docs

        if ($user->userDocumentRequirementOnePhoto) {
            $this->extraDocRequire1 = $this->getImageUrl($user->userDocumentRequirementOnePhoto->path);
        }

        if ($user->userDocumentRequirementTwoPhoto) {
            $this->extraDocRequire2 = $this->getImageUrl($user->userDocumentRequirementTwoPhoto->path);
        }

        if ($user->userDocumentRequirementThreePhoto) {
            $this->extraDocRequire3 = $this->getImageUrl($user->userDocumentRequirementThreePhoto->path);
        }

        if ($user->userDocumentRequirementFourPhoto) {
            $this->extraDocRequire4 = $this->getImageUrl($user->userDocumentRequirementFourPhoto->path);
        }

        if ($user->userDocumentRequirementFivePhoto) {
            $this->extraDocRequire5 = $this->getImageUrl($user->userDocumentRequirementFivePhoto->path);
        }

        if ($user->userDocumentRequirementSixPhoto) {
            $this->extraDocRequire6 = $this->getImageUrl($user->userDocumentRequirementSixPhoto->path);
        }

        if ($user->userDocumentRequirementSevenPhoto) {
            $this->extraDocRequire7 = $this->getImageUrl($user->userDocumentRequirementSevenPhoto->path);
        }

        if ($user->userDocumentRequirementEightPhoto) {
            $this->extraDocRequire8 = $this->getImageUrl($user->userDocumentRequirementEightPhoto->path);
        }

        if ($user->userDocumentRequirementNinePhoto) {
            $this->extraDocRequire9 = $this->getImageUrl($user->userDocumentRequirementNinePhoto->path);
        }

        if ($user->userDocumentRequirementTenPhoto) {
            $this->extraDocRequire10 = $this->getImageUrl($user->userDocumentRequirementTenPhoto->path);
        }

        // For Pdf Generation
        /*$this->userImage = Storage::disk(auth()->user()->image->disk)->url(auth()->user()->image->path);*/
        $this->userImage = $user?->image?->path ? MediaHelper::GetImageUrl($user?->image?->path) : null;

        $this->pdfData = [
            'title' => 'Sample PDF',
            
            // Challan ID and Application ID
            'challanId' => auth()->user()->challan_id,
            'applicationId' => auth()->user()->id,
            'experiences' => $this->experiences,
            // Personal Information
            'cnic' => $this->personalDetails->cnic_passport,
            'name' => auth()->user()->name,
            /*'foreigner' => $user->foreigner,*/
            'fatherName' => auth()->user()->father_name,
            'motherName' => $this->personalDetails->mother_name,
            'gender' => $this->personalDetails->gender->name,
            'nationality' => $this->personalDetails?->nationality?->name,
            'country' => $this->personalDetails?->country,
            'dateOfBirth' => $this->personalDetails?->date_of_birth,
            'districtOfDomicile' => $this->personalDetails?->district?->name,
            'areaOfResidence' => auth()->user()?->personalDetails?->area?->name,
            'mailingAddress' => $this->personalDetails?->address,
            'telephone' => $this->personalDetails?->telephone_number,
            'secondaryNumber' => $this->personalDetails?->secondary_number,
            'phoneNumber' => $this->personalDetails?->mobile_number,
            'email' => auth()->user()?->email,

            'image' => $this->userImage,
            // Qualifications Section
            'sscExam' => $this->qualifications->sscExam->name,
            'hsscExam' => $this->qualifications->hsscExam->name,
            'sscSubjects' => $this->qualifications->ssc_science_subjects,
            'hsscSubjects' => $this->qualifications->hssc_science_subjects,
            'sscInstitution' => $this->qualifications->sscInstitution->name,
            'sscRollNumber' => $this->qualifications->ssc_roll_no,
            'hsscInstitution' => $this->qualifications->hsscInstitution->name,
            'sscBoard' => $this->qualifications->sscBoard->name,
            'hsscBoard' => $this->qualifications->hsscBoard->name,
            'sccPassingYear' => $this->qualifications->ssc_passing_year,
            'hsccPassingYear' => $this->qualifications->hssc_passing_year,
            'sscMarks' => $this->qualifications->ssc_marks_obtained,
            'hsscMarks' => $this->qualifications->hssc_marks_obtained,
            'sscTotalMarks' => $this->qualifications->ssc_total_marks,
            'hsscTotalMarks' => $this->qualifications->hssc_total_marks,
            'hsscRollNumber' => $this->qualifications->hssc_roll_no,
            'nursingPassingYear' => $this->qualifications->nursing_passing_year,
            'nursingRollNumber' => $this->qualifications->nursing_roll_no,
            'nursingObtainedMarks' => $this->qualifications->nursing_marks_obtained,
            'nursingTotalMarks' => $this->qualifications->nursing_total_marks,
            'physics' => $this->qualifications->physics_score,
            'chemistry' => $this->qualifications->chemistry_score,
            'biology' => $this->qualifications->biology_score,
            'physicsTotal' => $this->qualifications->physics_total_score,
            'chemistryTotal' => $this->qualifications->chemistry_total_score,
            'biologyTotal' => $this->qualifications->biology_total_score,
            
            // Programs Name
            // 'programs'  => $this->program->name,
            
            // MBBS or BDS Prioirity
            'priority'  => auth()->user()->program_priority,

            // Foreigner
            'foreigner' => auth()?->user()?->foreigner,

            //Aggregate
            'aggregate' => auth()->user()->aggregate,
            'aggregate_overseas' => auth()->user()->aggregate_overseas !== null ? auth()->user()->aggregate_overseas : null,

            //MDACT INFORMATION
            // 'mdcatCnic' => $this->admissionTest->md_cat_cnic,
            // 'mdcatCenter' => optional($this->admissionTest->mdcatCenter)->name ?? 'N/A',
            // 'mdcatMarks' => $this->admissionTest->md_cat_obtained_marks,
            // 'mdcatApplicantCnic' => $this->personalDetails->cnic_passport,
            // 'mdcatPassingYear' => $this->admissionTest?->mdcatPassingYear?->name,
            
            //SAT INFORMATION
            // 'satTestDate' => $this->admissionTest->sat_test_date,
            // 'satBiologyMarks' => $this->admissionTest->sat_biology_obtained_marks,
            // 'satChemistryMarks' => $this->admissionTest->sat_chemistry_obtained_marks,
            // 'satPhyMathMarks' => $this->admissionTest->sat_phy_math_obtained_marks,
            // 'satUserName' => $this->admissionTest->sat_username,
            // 'satPassword' => $this->admissionTest->sat_password,
        
            //UCAT INFORMATION
            // 'ucatId' => $this->admissionTest->ucat_candidate_id,
            // 'ucatTestDate' => $this->admissionTest->ucat_test_date,
            // 'ucatObtainedMarks' => $this->admissionTest->ucat_obtained_marks,
            // 'ucatBandScore' => $this->admissionTest->ucat_band,

            // MCAT INFORMATION
            // 'mcatTestDate' => $this->admissionTest->mcat_test_date,
            // 'mcatObtaniedMarks' => $this->admissionTest->mcat_obtained_marks,
            // 'mcatUserName' => $this->admissionTest->mcat_username,
            // 'mcatPassword' => $this->admissionTest->mcat_password,

            //College Preferences
            'mbbsPreference' => !empty($mbbsCollegePreferences) ? json_decode($mbbsCollegePreferences[0], true) : [],
            'bdsPreference' => !empty($bdsCollegePreferences) ? json_decode($bdsCollegePreferences[0], true) : [],

            'morningPreference' => !empty($morningCollegePreferences) ? json_decode($morningCollegePreferences[0], true) : [],

            'eveningPreference' => !empty($eveningCollegePreferences) ? json_decode($eveningCollegePreferences[0], true) : [],

            'morningEveningPreference' => !empty($morningEveningCollegePreferences) ? json_decode($morningEveningCollegePreferences[0], true) : [],

            /*'mbbsForeignAsOpenMeritPreference' => !empty($mbbsCollegeForeignerAsOpenMeritPreferences) ? json_decode($mbbsCollegeForeignerAsOpenMeritPreferences[0], true) : [],
            'bdsForeignAsOpenMeritPreference' => !empty($bdsCollegeForeignerAsOpenMeritPreferences) ? json_decode($bdsCollegeForeignerAsOpenMeritPreferences[0], true) : [],*/

            // Documents Images
            'cnicImage' =>  $user?->userCnic?->path ? MediaHelper::GetImageUrl($user?->userCnic?->path) : null,

            'fatherCnicImage' =>  $user?->userFatherCnic?->path ? MediaHelper::GetImageUrl($user?->userFatherCnic?->path) : null,

            'signatureImage' => $user?->userSignatureImage?->path ? MediaHelper::GetImageUrl($user?->userSignatureImage?->path) : null,

            'photoImage' => $user?->userColorPhoto?->path ? MediaHelper::GetImageUrl($user?->userColorPhoto?->path) : null,

            'disabilityImage' => $user?->userDisabilityPhoto?->path ? MediaHelper::GetImageUrl($user?->userDisabilityPhoto?->path) : null,

            'schoolLeavingImage' =>  $user?->userSchoolLeavingPhoto?->path ? MediaHelper::GetImageUrl($user?->userSchoolLeavingPhoto?->path) : null,

            'cholistanCertificateImage' => $user?->userCholistanCertificatePhoto?->path ? MediaHelper::GetImageUrl($user?->userCholistanCertificatePhoto?->path) : null,

            'stayCardImage' =>  $user?->userStayCardPhoto?->path ? MediaHelper::GetImageUrl($user?->userStayCardPhoto?->path) : null,

            'intermediateTranscriptImage' =>  $user?->userIntermediateTranscriptPhoto?->path ? MediaHelper::GetImageUrl($user?->userIntermediateTranscriptPhoto?->path) : null,

            'verifiedByCeoImage' => $user?->userVerifiedByCeoPhoto?->path ? MediaHelper::GetImageUrl($user?->userVerifiedByCeoPhoto?->path) : null,

            'domicileCertificateImage' => $user?->userDomicileCertificatePhoto?->path ? MediaHelper::GetImageUrl($user?->userDomicileCertificatePhoto?->path) : null,

            'mdcatResultCardImage' => $user?->userMdcatResultCardPhoto?->path ? MediaHelper::GetImageUrl($user?->userMdcatResultCardPhoto?->path) : null,

            'matricTranscriptImage' => $user?->userMatricTranscriptPhoto?->path ? MediaHelper::GetImageUrl($user?->userMatricTranscriptPhoto?->path) : null,
            
            //New Docs
            'userCnicBackSide' => $user?->userCnicBackSide?->path ? MediaHelper::GetImageUrl($user?->userCnicBackSide?->path) : null,
            
            'userFatherCnicBackSide' =>  $user?->userFatherCnicBackSide?->path ? MediaHelper::GetImageUrl($user?->userFatherCnicBackSide?->path) : null,
            
            'userDisabilitySecondPhoto' =>  $user?->userDisabilitySecondPhoto?->path ? MediaHelper::GetImageUrl($user?->userDisabilitySecondPhoto?->path) : null,
            
            'userProvisionalCertificatePhoto' => $user?->userProvisionalCertificatePhoto?->path ? MediaHelper::GetImageUrl($user?->userProvisionalCertificatePhoto?->path) : null,
            
            'userUnderDevelopedFirstPhoto' =>  $user?->userUnderDevelopedFirstPhoto?->path ? MediaHelper::GetImageUrl($user?->userUnderDevelopedFirstPhoto?->path) : null,
            
            'userUnderDevelopedSecondPhoto' =>  $user?->userUnderDevelopedSecondPhoto?->path ? MediaHelper::GetImageUrl($user?->userUnderDevelopedSecondPhoto?->path) : null,
            
            'userUnderDevelopedThirdPhoto' =>  $user?->userUnderDevelopedThirdPhoto?->path ? MediaHelper::GetImageUrl($user?->userUnderDevelopedThirdPhoto?->path) : null,
           
            'userCholistanCertificateSecondPhoto' => $user?->userCholistanCertificateSecondPhoto?->path ? MediaHelper::GetImageUrl($user?->userCholistanCertificateSecondPhoto?->path) : null,
           
            'userForeignHsscCertificatePhoto' => $user?->userForeignHsscCertificatePhoto?->path ? MediaHelper::GetImageUrl($user?->userForeignHsscCertificatePhoto?->path) : null,
           
            'userIntermediateTranscriptBackSidePhoto' =>  $user?->userIntermediateTranscriptBackSidePhoto?->path ? MediaHelper::GetImageUrl($user?->userIntermediateTranscriptBackSidePhoto?->path) : null,
           
            'userMatricTranscriptBackSidePhoto' => $user?->userMatricTranscriptBackSidePhoto?->path ? MediaHelper::GetImageUrl($user?->userMatricTranscriptBackSidePhoto?->path) : null,
           
            'userEquivalenceSscPhoto' => $user?->userEquivalenceSscPhoto?->path ? MediaHelper::GetImageUrl($user?->userEquivalenceSscPhoto?->path) : null,
          
            'userEquivalenceHsscPhoto' =>  $user?->userEquivalenceHsscPhoto?->path ? MediaHelper::GetImageUrl($user?->userEquivalenceHsscPhoto?->path) : null,
           
            'userDocumentRequirementOnePhoto' =>  $user?->userDocumentRequirementOnePhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementOnePhoto?->path) : null,

            'userDocumentRequirementTwoPhoto' => $user?->userDocumentRequirementTwoPhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementTwoPhoto?->path) : null,

            'userDocumentRequirementThreePhoto' => $user?->userDocumentRequirementThreePhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementThreePhoto?->path) : null,
            
            'userDocumentRequirementFourPhoto' => $user?->userDocumentRequirementFourPhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementFourPhoto?->path) : null,
           
            'userDocumentRequirementFivePhoto' => $user?->userDocumentRequirementFivePhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementFivePhoto?->path) : null,
            
            'userDocumentRequirementSixPhoto' => $user?->userDocumentRequirementSixPhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementSixPhoto?->path) : null,
            
            'userDocumentRequirementSevenPhoto' => $user?->userDocumentRequirementSevenPhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementSevenPhoto?->path) : null,
            
            'userDocumentRequirementEightPhoto' => $user?->userDocumentRequirementEightPhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementEightPhoto?->path) : null,
            
            'userDocumentRequirementNinePhoto' => $user?->userDocumentRequirementNinePhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementNinePhoto?->path) : null,
            
            'userDocumentRequirementTenPhoto' =>  $user?->userDocumentRequirementTenPhoto?->path ? MediaHelper::GetImageUrl($user?->userDocumentRequirementTenPhoto?->path) : null,
            
        ];
    }

    /**
     * @param $path
     * @return string
     */
    private function getImageUrl($path): string
    {
        return Storage::disk("public")->url($path);
    }

    /**
     * @return StreamedResponse
     */
    public function downloadMyApllicationPdf(): StreamedResponse
    {
        $user = auth()->user()->id;
        $data = $this->pdfData;

        $pdfContent = PDF::loadView('livewire.pdf.myApplication',$data, ['satCnic'])->output();

        return response()->streamDownload(
            function () use ($pdfContent) {
                return print($pdfContent);
            },
            $user.".pdf"
        );
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('livewire.uhs-forms.application-status')
            ->extends('layouts.uhs-form')
            ->section('content');
    }
}