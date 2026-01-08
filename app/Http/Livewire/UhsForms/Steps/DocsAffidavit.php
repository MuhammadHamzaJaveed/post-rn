<?php

namespace App\Http\Livewire\UhsForms\Steps;

use App\Helpers\MediaHelper;
use App\Models\User;
use App\Services\ImageServices\ImageServices;
use App\Services\MediaServices\MediaServices;
use App\Services\UserServices\UserServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Response;

class DocsAffidavit extends Component
{
    use WithFileUploads;

    protected $mediaServices;

    protected $userServices;

    public $cnic;

    public $fatherCnic;

    public $signature;

    public $photo;

    public $disability;

    public $cholistanCertificate;

    public $stayCard;

    public $intermediateTranscript;

    public $terms;

    public $domicileCertificate;

    public $mdcatResultCard;

    public $matricTranscript;

    public $seatCategories = [];

    public $agreed;
    //work from here

    public $matricTranscriptBackSide;

    public $equivalenceCertificateSsc;

    public $intermediateTranscriptBackSide;

    public $equivalenceCertificateHssc;

    public $cnicBackSide;

    public $fatherCnicBackSide;

    //under developed data
    public $provisionalCertificate;

    public $schoolLeaving;

    public $verifiedByCeo;

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

    public $qualifications;

    public $admissionTest;

    public $mdcatCenters;

    public $seatCategory;

    public $mbbsPreference;

    public $bdsPreference;

    public $morningPreference;

    public $eveningPreference;

    public $program;

    public $personalDetails;

    private ImageServices $imageServices;

    /**
     * @return array
     */
    protected function rules(): array
    {
        $this->seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();

        $rules = [
            'agreed'                        => 'required | accepted',
        ];

        if (empty(auth()->user()->userDomicileCertificatePhoto) && empty($this->domicileCertificate)) {

            $rules += [
                'domicileCertificate' => ['required', 'image', 'max:1024'],
            ];

        }

        if (empty(auth()->user()->userMatricTranscriptPhoto) && empty($this->matricTranscript))
        {
            $rules += [
                'matricTranscript' => ['required', 'image', 'max:1024'],
            ];
        }

        if (empty(auth()->user()->userIntermediateTranscriptPhoto) && empty($this->intermediateTranscript))
        {
            $rules += [
                'intermediateTranscript' => ['required', 'image', 'max:1024'],
            ];
        }

        if (empty(auth()->user()->userCnic) && empty($this->cnic))
        {
            $rules += [
                'cnic' => ['required', 'image', 'max:1024'],
            ];
        }

        if (empty(auth()->user()->userCnicBackSide) && empty($this->cnicBackSide))
        {
            $rules += [
                'cnicBackSide' => ['required', 'image', 'max:1024'],
            ];
        }

        if (empty(auth()->user()->userFatherCnic) && empty($this->fatherCnic))
        {
            $rules += [
                'fatherCnic' => ['required', 'image', 'max:1024'],
            ];
        }

        if (empty(auth()->user()->userFatherCnicBackSide) && empty($this->fatherCnicBackSide))
        {
            $rules += [
                'fatherCnicBackSide' => ['required', 'image', 'max:1024'],
            ];
        }

        if (empty(auth()->user()->userColorPhoto) && empty($this->photo))
        {

            $rules += [
                'photo' => ['required', 'image', 'max:1024'],
            ];
        }




        if(empty(auth()->user()->userSignatureImage) && empty($this->signature)){
            $rules += [
                'signature' => ['required', 'image', 'max:1024'],
            ];

        }





        return $rules;
    }

    /**
     * Summary of boot
     * @param  UserServices  $userServices
     * @param  MediaServices  $mediaServices
     * @return void
     */
    public function boot(
        UserServices $userServices,
        MediaServices $mediaServices,
        ImageServices $imageServices
    
    )
    {
        $this->userServices = $userServices;
        $this->mediaServices = $mediaServices;
        $this->imageServices = $imageServices;
    }

    public function mount()
    {

        $user = auth()->user();
        // $this->setDocumentUrl($user, 'cnic', 'userCnic');
        // $this->setDocumentUrl($user, 'fatherCnic', 'userFatherCnic');
        // $this->setDocumentUrl($user, 'signature', 'userSignatureImage');
        // $this->setDocumentUrl($user, 'photo', 'userColorPhoto');
        // $this->setDocumentUrl($user, 'disability', 'userDisabilityPhoto');
        // $this->setDocumentUrl($user,'schoolLeaving','userSchoolLeavingPhoto');
        // $this->setDocumentUrl($user,'cholistanCertificate','userCholistanCertificatePhoto');
        // $this->setDocumentUrl($user, 'stayCard', 'userStayCardPhoto');
        // $this->setDocumentUrl($user, 'intermediateTranscript', 'userIntermediateTranscriptPhoto');
        // $this->setDocumentUrl($user, 'verifiedByCeo', 'userVerifiedByCeoPhoto');
        // $this->setDocumentUrl($user, 'domicileCertificate', 'userDomicileCertificatePhoto');
        // $this->setDocumentUrl($user, 'mdcatResultCard', 'userMdcatResultCardPhoto');
        // $this->setDocumentUrl($user, 'matricTranscriptBackSide', 'userMatricTranscriptBackSidePhoto');
        // $this->setDocumentUrl($user, 'equivalenceCertificateSsc', 'userEquivalenceSscPhoto');
        // $this->setDocumentUrl($user, 'intermediateTranscriptBackSide', 'userIntermediateTranscriptBackSidePhoto');
        // $this->setDocumentUrl($user, 'equivalenceCertificateHssc', 'userEquivalenceHsscPhoto');
        // $this->setDocumentUrl($user, 'cnicBackSide', 'userCnicBackSide');
        // $this->setDocumentUrl($user, 'fatherCnicBackSide', 'userFatherCnicBackSide');
        // $this->setDocumentUrl($user, 'matricTranscript', 'userMatricTranscriptPhoto');
        // $this->setDocumentUrl($user, 'provisionalCertificate', 'userProvisionalCertificatePhoto');
        // $this->setDocumentUrl($user, 'underDevelopedExtra1', 'userUnderDevelopedFirstPhoto');
        // $this->setDocumentUrl($user, 'underDevelopedExtra2', 'userUnderDevelopedSecondPhoto');
        // $this->setDocumentUrl($user, 'underDevelopedExtra3', 'userUnderDevelopedThirdPhoto');
        // $this->setDocumentUrl($user, 'cholistanCertificateSecond', 'userCholistanCertificateSecondPhoto');
        // $this->setDocumentUrl($user, 'disabilitySecond', 'userDisabilitySecondPhoto');
        // $this->setDocumentUrl($user, 'foreignHsscCertificate', 'userForeignHsscCertificatePhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire1', 'userDocumentRequirementOnePhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire2', 'userDocumentRequirementTwoPhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire3', 'userDocumentRequirementThreePhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire4', 'userDocumentRequirementFourPhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire5', 'userDocumentRequirementFivePhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire6', 'userDocumentRequirementSixPhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire7', 'userDocumentRequirementSevenPhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire8', 'userDocumentRequirementEightPhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire9', 'userDocumentRequirementNinePhoto');
        // $this->setDocumentUrl($user, 'extraDocRequire10', 'userDocumentRequirementTenPhoto');

        $this->seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();

        $this->terms = $user->accepted_terms_and_conditions;

        $this->personalDetails = auth()->user()->personalDetails;
        $this->qualifications = auth()->user()->qualifications;
        $this->admissionTest = auth()->user()->admissionTest;
        $this->program = auth()->user()->program;

        $morningCollegePreferences = auth()->user()->morningCollegePreferences->pluck('college_pref')->toArray();
        $this->morningPreference = !empty($morningCollegePreferences) ? json_decode($morningCollegePreferences[0], true) : [];

        /*$mbbsCollegePreferences = auth()->user()->mbbsCollegePreferences->pluck('college_pref')->toArray();
        $this->mbbsPreference = !empty($mbbsCollegePreferences) ? json_decode($mbbsCollegePreferences[0], true) : [];

        $bdsCollegePreferences = auth()->user()->bdsCollegePreferences->pluck('college_pref')->toArray();
        $this->bdsPreference = !empty($bdsCollegePreferences) ? json_decode($bdsCollegePreferences[0], true) : [];*/

        $eveningCollegePreferences = auth()->user()->eveningCollegePreferences->pluck('college_pref')->toArray();
        $this->eveningPreference = !empty($eveningCollegePreferences) ? json_decode($eveningCollegePreferences[0], true) : [];

        $this->seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();

    }
    protected $listeners = ['clearValidationError'];

    public function clearValidationError($field)
    {
        $this->resetErrorBag($field); // Clear validation error for the field
    }


    public function cnic()
    {
        $this->userCnic();
    }

    public function fatherCnic()
    {
        $this->userFatherCnic();
    }

    public function signature()
    {
        $this->userSignature();
    }

    public function photo()
    {
        $this->userColor();
    }


    public function disability()
    {
        $this->userDisability();
    }

    public function schoolLeaving()
    {
        $this->userSchoolLeaving();
    }

    public function cholistanCertificate()
    {
        $this->userCholistanCertificate();
    }

    public function stayCard()
    {
        $this->userStayCard();
    }

    public function intermediateTranscript()
    {
        $this->userIntermediateTranscript();
    }

    public function verifiedByCeo()
    {
        $this->userVerifiedByCeo();
    }

    public function domicileCertificate()
    {
        $this->userDomicileCertificate();
    }

    public function mdcatResultCard()
    {
        $this->userMdcatResultCard();
    }


    public function matricTranscriptBackSide()
    {
        $this->userMatricTranscriptBackSide();
    }

    public function equivalenceCertificateSsc()
    {
        $this->userEquivalenceSsc();
    }

    public function intermediateTranscriptBackSide()
    {
        $this->userIntermediateTranscriptBackSide();
    }

    public function equivalenceCertificateHssc()
    {
        $this->userEquivalenceHssc();
    }

    public function cnicBackSide()
    {
        $this->userCnicBackSide();
    }

    public function fatherCnicBackSide()
    {
        $this->userFatherCnicBackSide();
    }


    public function matricTranscript()
    {
        $this->userMatricTranscript();
    }

    public function provisionalCertificate()
    {
        $this->userProvisionalCertificate();
    }

    public function underDevelopedExtra1()
    {
        $this->userUnderDevelopedFirst();
    }

    public function underDevelopedExtra2()
    {
        $this->userUnderDevelopedSecond();
    }

    public function underDevelopedExtra3()
    {
        $this->userUnderDevelopedThird();
    }


    public function cholistanCertificateSecond()
    {
        $this->userCholistanCertificateSecond();
    }

    public function disabilitySecond()
    {
        $this->userDisabilitySecond();
    }

    public function foreignHsscCertificate()
    {
        $this->userForeignHsscCertificate();
    }


    public function extraDocRequire1()
    {
        $this->userDocumentRequirementOne();
    }

    public function extraDocRequire2()
    {
        $this->userDocumentRequirementTwo();
    }

    public function extraDocRequire3()
    {
        $this->userDocumentRequirementThree();
    }

    public function extraDocRequire4()
    {
        $this->userDocumentRequirementFour();
    }

    public function extraDocRequire5()
    {
        $this->userDocumentRequirementFive();
    }

    public function extraDocRequire6()
    {
        $this->userDocumentRequirementSix();
    }

    public function extraDocRequire7()
    {
        $this->userDocumentRequirementSeven();
    }

    public function extraDocRequire8()
    {
        $this->userDocumentRequirementEight();
    }

    public function extraDocRequire9()
    {
        $this->userDocumentRequirementNine();
    }

    public function extraDocRequire10()
    {
        $this->userDocumentRequirementTen();
    }


    /**
     * Triggered when the "Download PDF" button is clicked.
     */
    public function downloadGuidlinesPdf()
    {
        // Get the path to the PDF file
        $pdfPath = public_path('pdf/General Instructions (In English).pdf');
    
        // Check if the file exists
        if (!file_exists($pdfPath)) {
            return response()->json(['error' => 'PDF file not found'], 404);
        }
    
        // Generate a response to download the PDF
        return response()->stream(
            function () use ($pdfPath) {
                readfile($pdfPath);
            },
            200,
            [
                'Content-Type' => 'guidelines/pdf',
                'Content-Disposition' => 'attachment; filename="General_Instructions(English).pdf"',
            ]
        );
    }

    public function downloadGuidlinesUrduPdf()
    {
        // Get the path to the PDF file
        $pdfPath = public_path('pdf/General Instructions (in Urdu).pdf');
    
        // Check if the file exists
        if (!file_exists($pdfPath)) {
            return response()->json(['error' => 'PDF file not found'], 404);
        }
    
        // Generate a response to download the PDF
        return response()->stream(
            function () use ($pdfPath) {
                readfile($pdfPath);
            },
            200,
            [
                'Content-Type' => 'guidelines/pdf',
                'Content-Disposition' => 'attachment; filename="General_Instructions(Urdu).pdf"',
            ]
        );
    }
    
    /**
     * @param $path
     * @return string
     */
    private function getImageUrl($path): string
    {
        return Storage::disk(auth()->user()->image->disk)->url($path);
    }

    public function emailApllicationPdf()
    {
        $user = auth()->user();
        $mbbsCollegePreferences = $user->mbbsCollegePreferences->pluck('college_pref')->toArray();
        $mbbsCollegeForeignerAsOpenMeritPreferences = auth()->user()->mbbsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();
        $bdsCollegePreferences = $user->bdsCollegePreferences->pluck('college_pref')->toArray();
        $bdsCollegeForeignerAsOpenMeritPreferences = auth()->user()->bdsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();
        $seatCategory = $user->seatCategories->pluck('name')->toArray();

        $data = [
            'title' => 'Sample PDF',

            // Challan ID and Application ID
            'challanId' => $user->challan_id,
            'applicationId' => $user->id,

            // Personal Information
            'cnic' => $user?->personalDetails?->cnic_passport,
            'name' => $user?->name,
            'fatherName' => $user?->father_name,
            'motherName' => $user?->personalDetails?->mother_name,
            'gender' => $user->personalDetails?->gender?->name,
            'nationality' => $user?->personalDetails?->nationality?->name,
            'country' => $user?->personalDetails?->country,
            'dateOfBirth' => $user?->personalDetails?->date_of_birth,
            'districtOfDomicile' => $user?->personalDetails?->district?->name,
            'areaOfResidence' => $user?->personalDetails?->area->name,
            'mailingAddress' => $user?->personalDetails?->address,
            'telephone' => $user?->personalDetails?->telephone_number,
            'secondaryNumber' => $user?->personalDetails?->secondary_number,
            'phoneNumber' => $user?->personalDetails?->mobile_number,
            'email' => $user?->email,

            'image' => $user->image->path,
            // Qualifications Section
            'sscExam' => $user->qualifications->sscExam->name,
            'hsscExam' => $user->qualifications->hsscExam->name,
            'sscSubjects' => $user->qualifications->ssc_science_subjects,
            'hsscSubjects' => $user->qualifications->hssc_science_subjects,
            'sscInstitution' => $user->qualifications->sscInstitution->name,
            'sscRollNumber' => $user->qualifications->ssc_roll_no,
            'hsscInstitution' => $user->qualifications->hsscInstitution->name,
            'sscBoard' => $user->qualifications->sscBoard->name,
            'hsscBoard' => $user->qualifications->hsscBoard->name,
            'sccPassingYear' => $user->qualifications->ssc_passing_year,
            'hsccPassingYear' => $user->qualifications->hssc_passing_year,
            'sscMarks' => $user->qualifications->ssc_marks_obtained,
            'hsscMarks' => $user->qualifications->hssc_marks_obtained,
            'sscTotalMarks' => $user->qualifications->ssc_total_marks,
            'hsscTotalMarks' => $user->qualifications->hssc_total_marks,
            'hsscRollNumber' => $user->qualifications->hssc_roll_no,
            'physics' => $user->qualifications->physics_score,
            'chemistry' => $user->qualifications->chemistry_score,
            'biology' => $user->qualifications->biology_score,
            'physicsTotal' => $user->qualifications->physics_total_score,
            'chemistryTotal' => $user->qualifications->chemistry_total_score,
            'biologyTotal' => $user->qualifications->biology_total_score,

            // Programs Name
            'programs'  => $user->program->name,

            // MBBS or BDS Prioirity
            'priority'  => $user->program_priority,

            // Foreigner
            'foreigner' => $user?->foreigner,

            //Aggregate
            'aggregate' => $user->aggregate,
            'aggregate_overseas' => $user->aggregate_overseas !== null ? $user->aggregate_overseas : null,

            //MDACT INFORMATION
            // 'mdcatCnic' => $user->admissionTest->md_cat_cnic,
            // 'mdcatCenter' => optional($user->admissionTest->mdcatCenter)->name ?? 'N/A',
            // 'mdcatMarks' => $user->admissionTest->md_cat_obtained_marks,
            // 'mdcatApplicantCnic' => $user->personalDetails->cnic_passport,
            // 'mdcatPassingYear' => $user->admissionTest?->mdcatPassingYear?->name,

            //SAT INFORMATION
            // 'satTestDate' => $user->admissionTest->sat_test_date,
            // 'satBiologyMarks' => $user->admissionTest->sat_biology_obtained_marks,
            // 'satChemistryMarks' => $user->admissionTest->sat_chemistry_obtained_marks,
            // 'satPhyMathMarks' => $user->admissionTest->sat_phy_math_obtained_marks,
            // 'satUserName' => $user->admissionTest->sat_username,
            // 'satPassword' => $user->admissionTest->sat_password,

            //UCAT INFORMATION
            // 'ucatId' => $user->admissionTest->ucat_candidate_id,
            // 'ucatTestDate' => $user->admissionTest->ucat_test_date,
            // 'ucatObtainedMarks' => $user->admissionTest->ucat_obtained_marks,
            // 'ucatBandScore' => $user->admissionTest->ucat_band,

            // MCAT INFORMATION
            // 'mcatTestDate' => $user->admissionTest->mcat_test_date,
            // 'mcatObtaniedMarks' => $user->admissionTest->mcat_obtained_marks,
            // 'mcatUserName' => $user->admissionTest->mcat_username,
            // 'mcatPassword' => $user->admissionTest->mcat_password,

            //College Preferences
            'mbbsPreference' => !empty($mbbsCollegePreferences) ? json_decode($mbbsCollegePreferences[0], true) : [],
            'bdsPreference' => !empty($bdsCollegePreferences) ? json_decode($bdsCollegePreferences[0], true) : [],
            'mbbsForeignAsOpenMeritPreference' => !empty($mbbsCollegeForeignerAsOpenMeritPreferences) ? json_decode($mbbsCollegeForeignerAsOpenMeritPreferences[0], true) : [],
            'bdsForeignAsOpenMeritPreference' => !empty($bdsCollegeForeignerAsOpenMeritPreferences) ? json_decode($bdsCollegeForeignerAsOpenMeritPreferences[0], true) : [],

        ];

        $pdf = app()->make('dompdf.wrapper');

        // Load the view into the PDF
        $pdf->loadView('livewire.pdf.emailPdf', $data);
        $imagePath = $user->id . '_images/';
        // Output the PDF content
        // Save the PDF to storage
        $filename = 'applicationPdf-' . $user->id . '.pdf';
        $diskName = 'public';
        $filePath = $imagePath . $filename; // Adjust the path as needed
        Storage::disk($diskName)->put($filePath, $pdf->output());
    }

    public function submit()
    {
        $this->validate();

        $this->userServices->updateUser([
            'accepted_terms_and_conditions' => $this->terms,
         /*   'aggregate'                     => $this->calculateAggregate(),
            'aggregate_overseas'            => $this->calculateOverseasAggregate()*/

        ], auth()->user()->id);

        $this->userDomicileCertificate();
        $this->userMatricTranscript();
        $this->userMatricTranscriptBackSide();
        $this->userIntermediateTranscript();
        $this->userIntermediateTranscriptBackSide();
        $this->userMdcatResultCard();
        $this->userCnic();
        $this->userCnicBackSide();
        $this->userFatherCnic();
        $this->userFatherCnicBackSide();
        $this->userSignature();
        $this->userColor();

        $this->userDisability();
        $this->userSchoolLeaving();
        $this->userCholistanCertificate();
        $this->userStayCard();
        $this->userVerifiedByCeo();
        $this->userEquivalenceSsc();
        $this->userEquivalenceHssc();
        $this->userProvisionalCertificate();
        $this->userUnderDevelopedFirst();
        $this->userUnderDevelopedSecond();
        $this->userUnderDevelopedThird();
        $this->userCholistanCertificateSecond();
        $this->userDisabilitySecond();
        $this->userForeignHsscCertificate();

        //Extra Docs

        $this->userDocumentRequirementOne();

        $this->userDocumentRequirementTwo();

        $this->userDocumentRequirementThree();

        $this->userDocumentRequirementFour();

        $this->userDocumentRequirementFive();

        $this->userDocumentRequirementSix();

        $this->userDocumentRequirementSeven();

        $this->userDocumentRequirementEight();

        $this->userDocumentRequirementNine();

        $this->userDocumentRequirementTen();

//        $this->emailApllicationPdf();

        $this->emit('completeStep', 'step6Completed');
        $this->emit('goToStep', 7);
    }

    private function deleteOldImage($path)
    {
        if ($path) {
            // Delete the old image from the application storage
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * @param $image
     * @param $collection
     * @return array
     */
    //Old Code for Save Image without resize

    /*private function formatImageData($image, $collection): array
    {
        $customName = $collection; // Set a custom name based on the field name
        $imageName = time() . '_' . Str::random(8) . '.' . $image->extension();
        $imagePath = $image->storeAs(auth()->user()->id . '_images', $customName . '.' . $image->extension(), 'public');

        return [
            'imageName'  => $customName . '.' . $image->extension(), // Use the custom name as the image name
            'imagePath'  => $imagePath,
            'imageSize'  => $image->getSize(),
            'userId'     => auth()->user()->id,
            'model'      => User::class,
            'disk'       => "public",
            'collection' => $collection,
        ];
    }*/

    // End Old Code for Save Image without resize

    // New Code for Save Image with resize
    public function formatImageData($image, $collection, $status=false): array
    {
        $newWidth = 700;
        $newHeight = 600;

        $sourcePath = $this->getImagePath($image);

        $extension = $image->extension();
        $originalImage = $this->loadImage($sourcePath, $extension);

        list($width, $height) = getimagesize($sourcePath);

        $resizedImage = $this->resizeImage($originalImage, $width, $height, $newWidth, $newHeight);

        $storagePath = $this->generateStoragePath($collection, $extension, $status);
        $imagePath = storage_path('app/public/' . $storagePath);

        $this->ensureDirectoryExists(dirname($imagePath));
        $this->saveImage($resizedImage, $imagePath, $extension);

        imagedestroy($originalImage);
        imagedestroy($resizedImage);

        return $this->getFormattedImageData($storagePath, $collection, $extension, $imagePath);
    }

    private function getImagePath($image)
    {
        $sourcePath = $image?->getRealPath();
        if (!file_exists($sourcePath)) {
            throw new \Exception('File does not exist at the specified path');
        }
        return $sourcePath;
    }

    private function loadImage($path, $extension)
    {
        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($path);
            case 'png':
                return imagecreatefrompng($path);
            case 'gif':
                return imagecreatefromgif($path);
            default:
                throw new Exception('Unsupported image type');
        }
    }

    private function resizeImage($originalImage, $width, $height, $newWidth, $newHeight)
    {
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        return $resizedImage;
    }

    private function generateStoragePath($collection, $extension, $status)
    {
        if ($status) {
            return auth()->user()->name . '_' . auth()->user()->id . '_images/' . $collection . '_status' . '.' . $extension;
        }
        return auth()->user()->id . '_images/' . $collection . '.' . $extension;
    }

    private function ensureDirectoryExists($directoryPath)
    {
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
    }

    private function saveImage($resizedImage, $path, $extension)
    {
        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($resizedImage, $path, 90);
                break;
            case 'png':
                imagepng($resizedImage, $path);
                break;
            case 'gif':
                imagegif($resizedImage, $path);
                break;
        }
    }

    private function getFormattedImageData($storagePath, $collection, $extension, $imagePath)
    {
        return [
            'imageName'  => $collection . '.' . $extension,
            'imagePath'  => $storagePath,
            'imageSize'  => filesize($imagePath),
            'userId'     => auth()->user()->id,
            'model'      => User::class,
            'disk'       => 'public',
            'collection' => $collection,
        ];
    }

    // End New Code for Save Image with resize

    private function calculateAggregate()
    {
        $qualifications = auth()->user()->qualifications;
        $admissionTest = auth()->user()->admissionTest;

        $sscObtainedMarks = $qualifications->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications->hssc_marks_obtained;

        $mdCatObtainedMarks = $admissionTest->md_cat_obtained_marks;

        $programId = auth()->user()->program_id;

        if (
            ($sscObtainedMarks && $hsscObtainedMarks) &&
            ($mdCatObtainedMarks)
        ) {
            $averageTotal = 1100;

            $ssc =  $sscObtainedMarks / $qualifications->ssc_total_marks * $averageTotal * 0.10;
            $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;

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
        

        $qualifications = auth()->user()->qualifications;
        $admissionTest = auth()->user()->admissionTest;

        $sscObtainedMarks = $qualifications->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications->hssc_marks_obtained;

        $mCatObtainedMarks = $admissionTest->mcat_obtained_marks;
        $mdCatObtainedMarks = $admissionTest->md_cat_obtained_marks;
        $uCatObtainedMarks = $admissionTest->ucat_obtained_marks;
        $satObtainedMarks = ($admissionTest->sat_biology_obtained_marks * 0.40) + 
            ($admissionTest->sat_chemistry_obtained_marks * 0.35) +
            ($admissionTest->sat_phy_math_obtained_marks * 0.25); 

        $programId = auth()->user()->program_id;

        if (
            ($sscObtainedMarks && $hsscObtainedMarks) &&
            ($mdCatObtainedMarks || $uCatObtainedMarks || $satObtainedMarks || $mCatObtainedMarks)
        ) {
            $averageTotal = 1100;

            $ssc =  $sscObtainedMarks / $qualifications->ssc_total_marks * $averageTotal * 0.10;
            $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;

            $aggregation = [];

            $mdCatPercentile = $mdCatObtainedMarks / 200 * 100;

            if ((
                ($programId == 1 || $programId == 3) && $mdCatPercentile >= 55) ||
                ($programId == 2 && $mdCatPercentile >= 50))
            {
                if ($mdCatObtainedMarks) {
                    $mdCat = $mdCatObtainedMarks / 200 * $averageTotal * 0.50;

                    $aggregation['mdCat'] = ($ssc + $hssc + $mdCat) / $averageTotal * 100 ;
                }
            } else {
                $aggregation['mdCat'] = 0;
            }

            if ($uCatObtainedMarks) {
                $uCat = $uCatObtainedMarks / 3600 * $averageTotal * 0.50;

                $aggregation['uCat'] = ($ssc + $hssc + $uCat) / $averageTotal * 100 ;
            }

            if ($satObtainedMarks) {
                $sat2 = $satObtainedMarks / 800 * $averageTotal * 0.50;

                $aggregation['sat2'] = ($ssc + $hssc + $sat2) / $averageTotal * 100 ;
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

    private function setDocumentUrl($user, $property, $document): void
    {
        if ($user->$document) {
            $this->$property = Storage::disk(auth()->user()->$document->disk)->url(auth()->user()->$document->path);
        }
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.docs-affidavit');
    }

    /**
     * @return void
     */
    protected function userCnic()
    {
        if (!is_string($this->cnic) && $this->cnic) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()?->userCnic?->id,
            ], $this->formatImageData($this->cnic, 'userCnic'));
            $this->resetErrorBag('cnic');
            $this->cnic = null;
        }
    }

    /**
     * @return void
     */
    protected function userFatherCnic(): void
    {
        if (!is_string($this->fatherCnic) && $this->fatherCnic) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userFatherCnic?->id,
            ], $this->formatImageData($this->fatherCnic, 'userFatherCnic'));
            $this->resetErrorBag('fatherCnic');
            $this->fatherCnic = null;
        }
    }

    /**
     * @return void
     */
    protected function userSignature(): void
    {
        if (!is_string($this->signature) && $this->signature) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userSignatureImage?->id,
            ], $this->formatImageData($this->signature, 'signature'));
            $this->resetErrorBag('signature');
            $this->signature = null;
        }

    }

    /**
     * @return void
     */
    protected function userColor(): void
    {
        if (!is_string($this->photo) && $this->photo) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userColorPhoto?->id,
            ], $this->formatImageData($this->photo, 'userColorPhoto'));
            $this->resetErrorBag('photo');
            $this->photo = null;
        }
    }

    /**
     * @return void
     */
    protected function userDisability(): void
    {
        if (!is_string($this->disability) && $this->disability) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDisabilityPhoto?->id,
            ], $this->formatImageData($this->disability, 'userDisabilityPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userSchoolLeaving(): void
    {
        if (!is_string($this->schoolLeaving) && $this->schoolLeaving) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userSchoolLeavingPhoto?->id,
            ], $this->formatImageData($this->schoolLeaving, 'userSchoolLeavingPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userCholistanCertificate(): void
    {
        if (!is_string($this->cholistanCertificate) && $this->cholistanCertificate) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userCholistanCertificatePhoto?->id,
            ], $this->formatImageData($this->cholistanCertificate, 'userCholistanCertificatePhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userStayCard(): void
    {
        if (!is_string($this->stayCard) && $this->stayCard) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userStayCardPhoto?->id,
            ], $this->formatImageData($this->stayCard, 'userStayCardPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userIntermediateTranscript(): void
    {
        if (!is_string($this->intermediateTranscript) && $this->intermediateTranscript) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userIntermediateTranscriptPhoto?->id,
            ], $this->formatImageData($this->intermediateTranscript, 'userIntermediateTranscriptPhoto'));
            $this->resetErrorBag('intermediateTranscript');
            $this->intermediateTranscript = null;
        }
    }

    /**
     * @return void
     */
    protected function userVerifiedByCeo(): void
    {
        if (!is_string($this->verifiedByCeo) && $this->verifiedByCeo) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userVerifiedByCeoPhoto?->id,
            ], $this->formatImageData($this->verifiedByCeo, 'userVerifiedByCeoPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userDomicileCertificate()
    {
        if (!is_string($this->domicileCertificate) && $this->domicileCertificate) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDomicileCertificatePhoto?->id,
            ], $this->formatImageData($this->domicileCertificate, 'userDomicileCertificatePhoto'));

            $this->resetErrorBag('domicileCertificate');
            // Optionally, reset the input field
            $this->domicileCertificate = null;
        }
    }

    /**
     * @return void
     */
    protected function userMdcatResultCard(): void
    {
        if (!is_string($this->mdcatResultCard) && $this->mdcatResultCard) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userMdcatResultCardPhoto?->id,
            ], $this->formatImageData($this->mdcatResultCard, 'userMdcatResultCardPhoto'));
            $this->resetErrorBag('mdcatResultCard');
            $this->mdcatResultCard = null;

        }
    }

    /**
     * @return void
     */
    protected function userMatricTranscriptBackSide(): void
    {
        if (!is_string($this->matricTranscriptBackSide) && $this->matricTranscriptBackSide) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userMatricTranscriptBackSidePhoto?->id,
            ], $this->formatImageData($this->matricTranscriptBackSide, 'userMatricTranscriptBackSidePhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userEquivalenceSsc(): void
    {
        if (!is_string($this->equivalenceCertificateSsc) && $this->equivalenceCertificateSsc) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userEquivalenceSscPhoto?->id,
            ], $this->formatImageData($this->equivalenceCertificateSsc, 'userEquivalenceSscPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userIntermediateTranscriptBackSide(): void
    {
        if (!is_string($this->intermediateTranscriptBackSide) && $this->intermediateTranscriptBackSide) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userIntermediateTranscriptBackSidePhoto?->id,
            ], $this->formatImageData($this->intermediateTranscriptBackSide,
                'userIntermediateTranscriptBackSidePhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userEquivalenceHssc(): void
    {
        if (!is_string($this->equivalenceCertificateHssc) && $this->equivalenceCertificateHssc) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userEquivalenceHsscPhoto?->id,
            ], $this->formatImageData($this->equivalenceCertificateHssc, 'userEquivalenceHsscPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userCnicBackSide(): void
    {
        if (!is_string($this->cnicBackSide) && $this->cnicBackSide) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userCnicBackSide?->id,
            ], $this->formatImageData($this->cnicBackSide, 'userCnicBackSide'));

            $this->resetErrorBag('cnicBackSide');
            $this->cnicBackSide = null;
        }
    }

    /**
     * @return void
     */
    protected function userFatherCnicBackSide(): void
    {
        if (!is_string($this->fatherCnicBackSide) && $this->fatherCnicBackSide) {

            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userFatherCnicBackSide?->id,
            ], $this->formatImageData($this->fatherCnicBackSide, 'userFatherCnicBackSide'));

            $this->resetErrorBag('fatherCnicBackSide');
            $this->fatherCnicBackSide = null;

        }
    }


    /**
     * @return void
     */
    protected function userMatricTranscript(): void
    {
        if (!is_string($this->matricTranscript) && $this->matricTranscript) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userMatricTranscriptPhoto?->id,
            ], $this->formatImageData($this->matricTranscript, 'userMatricTranscriptPhoto'));

            $this->resetErrorBag('matricTranscript');
            $this->matricTranscript = null;

        }
    }

    /**
     * @return void
     */
    protected function userProvisionalCertificate(): void
    {
        if (!is_string($this->provisionalCertificate) && $this->provisionalCertificate) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userProvisionalCertificatePhoto?->id,
            ], $this->formatImageData($this->provisionalCertificate, 'userProvisionalCertificatePhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userUnderDevelopedFirst(): void
    {
        if (!is_string($this->underDevelopedExtra1) && $this->underDevelopedExtra1) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userUnderDevelopedFirstPhoto?->id,
            ], $this->formatImageData($this->underDevelopedExtra1, 'userUnderDevelopedFirstPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userUnderDevelopedSecond(): void
    {
        if (!is_string($this->underDevelopedExtra2) && $this->underDevelopedExtra2) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userUnderDevelopedSecondPhoto?->id,
            ], $this->formatImageData($this->underDevelopedExtra2, 'userUnderDevelopedSecondPhoto'));
        }
    }
    /**
     * @return void
     */
    protected function userUnderDevelopedThird(): void
    {
        if (!is_string($this->underDevelopedExtra3) && $this->underDevelopedExtra3) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userUnderDevelopedThirdPhoto?->id,
            ], $this->formatImageData($this->underDevelopedExtra3, 'userUnderDevelopedThirdPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userCholistanCertificateSecond(): void
    {
        if (!is_string($this->cholistanCertificateSecond) && $this->cholistanCertificateSecond) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userCholistanCertificateSecondPhoto?->id,
            ], $this->formatImageData($this->cholistanCertificateSecond, 'userCholistanCertificateSecondPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userDisabilitySecond(): void
    {
        if (!is_string($this->disabilitySecond) && $this->disabilitySecond) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDisabilitySecondPhoto?->id,
            ], $this->formatImageData($this->disabilitySecond, 'userDisabilitySecondPhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userForeignHsscCertificate(): void
    {
        if (!is_string($this->foreignHsscCertificate) && $this->foreignHsscCertificate) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userForeignHsscCertificatePhoto?->id,
            ], $this->formatImageData($this->foreignHsscCertificate, 'userForeignHsscCertificatePhoto'));
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementOne(): void
    {
        if (!is_string($this->extraDocRequire1) && $this->extraDocRequire1) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementOnePhoto?->id,
            ], $this->formatImageData($this->extraDocRequire1, 'userDocumentRequirementOnePhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementOnePhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementOnePhoto->path);
                auth()->user()->userDocumentRequirementOnePhoto->delete();
            }
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementTwo(): void
    {
        if (!is_string($this->extraDocRequire2) && $this->extraDocRequire2) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementTwoPhoto?->id,
            ], $this->formatImageData($this->extraDocRequire2, 'userDocumentRequirementTwoPhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementTwoPhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementTwoPhoto->path);
                auth()->user()->userDocumentRequirementTwoPhoto->delete();
            }
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementThree(): void
    {
        if (!is_string($this->extraDocRequire3) && $this->extraDocRequire3) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementThreePhoto?->id,
            ], $this->formatImageData($this->extraDocRequire3, 'userDocumentRequirementThreePhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementThreePhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementThreePhoto->path);
                auth()->user()->userDocumentRequirementThreePhoto->delete();
            }
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementFour(): void
    {
        if (!is_string($this->extraDocRequire4) && $this->extraDocRequire4) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementFourPhoto?->id,
            ], $this->formatImageData($this->extraDocRequire4, 'userDocumentRequirementFourPhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementFourPhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementFourPhoto->path);
                auth()->user()->userDocumentRequirementFourPhoto->delete();
            }
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementFive(): void
    {
        if (!is_string($this->extraDocRequire5) && $this->extraDocRequire5) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementFivePhoto?->id,
            ], $this->formatImageData($this->extraDocRequire5, 'userDocumentRequirementFivePhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementFivePhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementFivePhoto->path);
                auth()->user()->userDocumentRequirementFivePhoto->delete();
            }
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementSix(): void
    {
        if (!is_string($this->extraDocRequire6) && $this->extraDocRequire6) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementSixPhoto?->id,
            ], $this->formatImageData($this->extraDocRequire6, 'userDocumentRequirementSixPhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementSixPhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementSixPhoto->path);
                auth()->user()->userDocumentRequirementSixPhoto->delete();
            }
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementSeven(): void
    {
        if (!is_string($this->extraDocRequire7) && $this->extraDocRequire7) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementSevenPhoto?->id,
            ], $this->formatImageData($this->extraDocRequire7, 'userDocumentRequirementSevenPhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementSevenPhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementSevenPhoto->path);
                auth()->user()->userDocumentRequirementSevenPhoto->delete();
            }
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementEight(): void
    {
        if (!is_string($this->extraDocRequire8) && $this->extraDocRequire8) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementEightPhoto?->id,
            ], $this->formatImageData($this->extraDocRequire8, 'userDocumentRequirementEightPhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementEightPhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementEightPhoto->path);
                auth()->user()->userDocumentRequirementEightPhoto->delete();
            }
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementNine(): void
    {
        if (!is_string($this->extraDocRequire9) && $this->extraDocRequire9) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementNinePhoto?->id,
            ], $this->formatImageData($this->extraDocRequire9, 'userDocumentRequirementNinePhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementNinePhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementNinePhoto->path);
                auth()->user()->userDocumentRequirementNinePhoto->delete();
            }
        }
    }

    /**
     * @return void
     */
    protected function userDocumentRequirementTen(): void
    {
        if (!is_string($this->extraDocRequire10) && $this->extraDocRequire10) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userDocumentRequirementTenPhoto?->id,
            ], $this->formatImageData($this->extraDocRequire10, 'userDocumentRequirementTenPhoto'));
        } else {
            if (auth()->user()->userDocumentRequirementTenPhoto) {
                Storage::delete(auth()->user()->userDocumentRequirementTenPhoto->path);
                auth()->user()->userDocumentRequirementTenPhoto->delete();
            }
        }
    }
    /**
     * @return void
     */

}
