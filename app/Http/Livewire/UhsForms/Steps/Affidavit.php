<?php

namespace App\Http\Livewire\UhsForms\Steps;

use App\Jobs\ApplicationEditEmail;
use App\Jobs\SendEmails;
use App\Services\ImageServices\ImageServices;
use App\Traits\SmsApi;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Mail\UserPDFMail;
use App\Mail\UserRequestPdfMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Notifications\UserPdfNotification;
use App\Services\UserServices\UserServices;
use Illuminate\Support\Facades\Notification;
use App\Services\MediaServices\MediaServices;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Livewire\WithFileUploads;
use PDF;



class Affidavit extends Component
{
    use WithFileUploads,SmsApi;
    public $name;

    public $fatherName;

    protected $mediaServices;

    protected $userServices;

    public $fatherCnicAffidavit;


    public $terms;
    private ImageServices $imageServices;

    /**
     * @return void
     */

    /**
     * @return array
     */
    protected function rules(): array
    {
        $rules = [
            'terms'               => 'required',
            /*'fatherCnicAffidavit' => ['required', 'image', 'max:4096',],*/
        ];

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
        /*if (auth()->user()->userFatherCnicAffidavit) {
            $this->fatherCnicAffidavit = Storage::disk(auth()->user()->userFatherCnicAffidavit->disk)->url(auth()->user()->userFatherCnicAffidavit->path);
        }*/
        $user = auth()->user();
        $this->terms = auth()->user()->accepted_terms_and_conditions;
        $this->name = auth()->user()->name;
        $this->fatherName = auth()->user()->father_name;



    }

    protected $listeners = ['clearValidationError'];

    public function clearValidationError($field)
    {
        $this->resetErrorBag($field); // Clear validation error for the field
    }

    private function sendCompletionEmailWithPDF()
    {
        $user = auth()->user();
        $mbbsCollegePreferences = auth()->user()->mbbsCollegePreferences->pluck('college_pref')->toArray();
        $mbbsCollegeForeignerAsOpenMeritPreferences = auth()->user()->mbbsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();
        $bdsCollegePreferences = auth()->user()->bdsCollegePreferences->pluck('college_pref')->toArray();
        $bdsCollegeForeignerAsOpenMeritPreferences = auth()->user()->bdsCollegeForeignerAsOpenMeritPreferences->pluck('college_pref')->toArray();

        $pdfData = [
            'title' => 'Sample PDF',
            // Challan ID and Application ID
            'challanId' => $user->challan_id,
            'applicationId' => $user->id,
            'seatCategory' => $user->seatCategories->pluck('id')->toArray(),
            // Personal Information
            'cnic' => $user->personalDetails->cnic_passport,
            'name' => $user->name,
            'foreigner' => $user->foreigner,
            'fatherName' => $user->father_name,
            'motherName' => $user->personalDetails->mother_name,
            'gender' => $user->personalDetails->gender->name,
            'nationality' => $user->personalDetails?->nationality?->name,
            'country' => $user->personalDetails->country,
            'dateOfBirth' => $user->personalDetails->date_of_birth,
            'districtOfDomicile' => $user->personalDetails->district?->name,
            'areaOfResidence' => $user->personalDetails->area->name,
            'mailingAddress' => $user->personalDetails->address,
            'telephone' => $user->personalDetails->telephone_number,
            'secondaryNumber' => $user->personalDetails->secondary_number,
            'phoneNumber' => $user->personalDetails->mobile_number,
            'email' => $user->email,
            // Qualifications Section
            'sscExam' => $user->qualifications->sscExam->name,
            'hsscExam' => $user->qualifications->hsscExam->name,
            'sscSubjects' => $user->qualifications->ssc_science_subjects,
            'hsscSubjects' => $user->qualifications->hssc_science_subjects,
            'sscInstitution' => $user->qualifications->sscInstitution->name,
            'sscRollNumber' => $user->qualifications->ssc_roll_no,
            'hsscRollNumber' => $user->qualifications->hssc_roll_no,
            'hsscInstitution' => $user->qualifications->hsscInstitution->name,
            'sscBoard' => $user->qualifications->sscBoard->name,
            'hsscBoard' => $user->qualifications->hsscBoard->name,
            'sccPassingYear' => $user->qualifications->ssc_passing_year,
            'hsccPassingYear' => $user->qualifications->hssc_passing_year,
            'sscMarks' => $user->qualifications->ssc_marks_obtained,
            'hsscMarks' => $user->qualifications->hssc_marks_obtained,
            'sscTotalMarks' => $user->qualifications->ssc_total_marks,
            'hsscTotalMarks' => $user->qualifications->hssc_total_marks,
            'physics' => $user->qualifications->physics_score,
            'chemistry' => $user->qualifications->chemistry_score,
            'biology' => $user->qualifications->biology_score,
            'physicsTotal' => $user->qualifications->physics_total_score,
            'chemistryTotal' => $user->qualifications->chemistry_total_score,
            'biologyTotal' => $user->qualifications->biology_total_score,
            // Programs Name
            'programs' => $user?->program?->name,
            // Seats Category
            'seats' => implode(', ', $user->seatCategories->pluck('name')->toArray()),
            //Aggregate
            'aggregate' => $user->aggregate,
            'aggregate_overseas' => $user->aggregate_overseas !== null ? $user->aggregate_overseas : null,
            //MDACT INFORMATION
            'mdcatCnic' => $user->admissionTest?->md_cat_cnic,
            'mdcatCenter' => optional($user?->admissionTest?->mdcatCenter)?->name ?? 'N/A',
            'mdcatMarks' => $user->admissionTest?->md_cat_obtained_marks,
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

        dispatch(new ApplicationEditEmail(
                $user->email,
                $user->is_paid == 1 ? base64_encode($pdfContent) : null,
                /*base64_encode($pdfContent),*/
                auth()->user()->is_paid
            )
        );
    }

    public function fatherCnicAffidavit()
    {
        $this->userFatherCnicAffidavit();
    }

    /**
     * @param $path
     * @return string
     */
    private function getImageUrl($path): string
    {
        return Storage::disk(auth()->user()->image->disk)->url($path);
    }

    public function submit()
    {
        $this->validate();

        $this->userServices->updateUser([
            'accepted_terms_and_conditions' => $this->terms,
        ], auth()->user()->id);

        $this->userFatherCnicAffidavit();
        /*$imagePath = 'NFS-UHSP/'.auth()->user()->id . '_images/';*/
//        $imagePath = auth()->user()->id . '_images/';
//
//        $filename = 'applicationPdf-' . auth()->user()->id . '.pdf';
//        $filePath = $imagePath . $filename;
//
//        /*   $phone_number = auth()->user()->personalDetails->mobile_number;
//             $applicationid = auth()->user()->id;
//
//             $message = "Your application has been successfully submitted on private.uhs.edu.pk. Your application id is ".$applicationid.". ";*/
//
//        /*$this->sendSms($phone_number, $message);*/
//
//        dispatch(new SendEmails( auth()->user()->email));

        if (empty(auth()->user()->submitted_at)) {
            auth()->user()->update([
                'submitted_at' => now(),
            ]);

            $phone_number = auth()->user()->personalDetails->mobile_number;
            $applicationid = auth()->user()->id;

            /*$message = "Your application has been successfully submitted on public.uhs.edu.pk. Your application id is " . $applicationid . ". ";*/

            /*$this->sendSms($phone_number, $message);*/

            $imagePath = auth()->user()->id . '_images/';

            $filename = 'applicationPdf-' . auth()->user()->id . '.pdf';
            $filePath = $imagePath . $filename;

            dispatch(new SendEmails(auth()->user()->email));

        } else {
            auth()->user()->update([
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            /*$this->sendCompletionEmailWithPDF();*/
        }


        /*$this->emit('openModal', 'uhs-forms.modal.image-submitted-successfully');*/

        $this->emit('completeStep', 'step7Completed');
        $this->emit('showApplicationIncompleteModal');
        /*$this->emit('openModal', 'uhs-forms.modal.form-submitted-successfully');*/
    }
//    private function formatImageData($image, $collection): array
//    {
//        $customName = $collection; // Set a custom name based on the field name
//        $imageName = time() . '_' . Str::random(8) . '.' . $image->extension();
//        $imagePath = $image->storeAs(auth()->user()->name . '_' . auth()->user()->id . '_images', $customName . '.' . $image->extension(), 'public');
//        return [
//            'imageName'  => $customName . '.' . $image->extension(), // Use the custom name as the image name
//            /*'imagePath'  => 'NFS-UHSP/'.$imagePath,*/
//            'imagePath'  => $imagePath,
//            'imageSize'  => $image->getSize(),
//            'userId'     => auth()->user()->id,
//            'model'      => User::class,
//            'disk'       => $image->disk,
//            'collection' => $collection,
//        ];
//    }

    /*    private function formatImageData($image, $collection): array
        {
            $newWidth = 800;
            $newHeight = 600;

            $sourcePath = $this->getImagePath($image);

            $extension = $image->extension();
            $originalImage = $this->loadImage($sourcePath, $extension);

            list($width, $height) = getimagesize($sourcePath);

            $resizedImage = $this->resizeImage($originalImage, $width, $height, $newWidth, $newHeight);

            $storagePath = $this->generateStoragePath($collection, $extension);
            $imagePath = storage_path('app/public/' . $storagePath);

            $this->ensureDirectoryExists(dirname($imagePath));
            $this->saveImage($resizedImage, $imagePath, $extension);

            imagedestroy($originalImage);
            imagedestroy($resizedImage);

            return $this->getFormattedImageData($storagePath, $collection, $extension, $imagePath);
        }

        private function getImagePath($image)
        {
            $sourcePath = $image->getRealPath();
            if (!file_exists($sourcePath)) {
                throw new Exception('File does not exist at the specified path');
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

        private function generateStoragePath($collection, $extension)
        {
            return auth()->user()->name . '_' . auth()->user()->id . '_images/' . $collection . '.' . $extension;
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
        }*/


    protected function userFatherCnicAffidavit(): void
    {
        if (empty(auth()->user()->userFatherCnicAffidavit) && empty($this->fatherCnicAffidavit))
        {
            $this->validate([
                'fatherCnicAffidavit' => 'required',
            ]);
        }
        if (!is_string($this->fatherCnicAffidavit) && $this->fatherCnicAffidavit) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userFatherCnicAffidavit?->id
            ],
                $this->imageServices->formatImageData(
                    $this->fatherCnicAffidavit,
                    'userFatherCnicAffidavit',
                    true
                )
            /*$this->formatImageData($this->fatherCnicAffidavit, 'userFatherCnicAffidavit')*/
            );
            $this->resetErrorBag('fatherCnicAffidavit');
            $this->fatherCnicAffidavit = null;
        }
    }


    public function render()
    {
        return view('livewire.uhs-forms.steps.affidavit');
    }
}
