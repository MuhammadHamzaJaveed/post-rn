<?php

namespace App\Http\Livewire\UhsForms;

use App\Enums\Otp\OtpReasons;
use App\Enums\Otp\OtpTypes;
use App\Jobs\SendOtpEmail;
use App\Models\MeritListFromCollege;
use App\Models\OTPS;
use App\Models\SelectionList;
use App\Models\User;
use App\Services\MediaServices\MediaServices;
use App\Services\UserServices\UserServices;
use App\Traits\SmsApi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use PDF;
use Symfony\Component\HttpFoundation\StreamedResponse;

class After_Dashboard extends Component
{
    use WithFileUploads, SmsApi;

    protected $mediaServices;

    protected $userServices;

    public $image;

    public $challan;

    public $admissionChallan;

    public $personalDetails;

    public $seatCategories = [];

    public $challanSubmitted = false;

    public $challanStatus = false;

    public $admissionChallanStatus = false;

    public $isJoined = false;

    public $isStay = false;
    public $isStayOrUpgraded = false;

    public $selectedCollegeId = 0;

    public $selectionList;

    public $allUserColleges;

    public $studentAffidavit;

    public $fileName;
    public $filePath;

    public $seatCategory;
    public $isOpenMerit;
    public $isOversease;
    public $is_Stayed;
    public $is_Upgraded;
    public $sameCollege;

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'admissionChallan' => 'required',
        ];
    }

    /**
     * Summary of boot
     * @param MediaServices $mediaServices
     * @param UserServices $userServices
     * @return void
     */
    public function boot(MediaServices $mediaServices, UserServices $userServices)
    {
        $this->mediaServices = $mediaServices;
        $this->userServices = $userServices;
    }

    public function mount()
    {
        $this->allUserColleges = MeritListFromCollege::query()
            ->where('user_id', auth()->id())
            ->with(['college', 'selectionList'])
            ->get()
            ->reject(function ($selectionItem) use (&$previousMeritStatus) {
                $currentMerit = $selectionItem?->meritListFromCollege?->first();
                if (!$currentMerit) {
                    return false;
                }
                $currentIsStay = $currentMerit->is_stay ?? false;
                $currentIsJoined = $currentMerit->is_joined ?? false;
                if (isset($previousMeritStatus) && $previousMeritStatus['is_stay'] && $previousMeritStatus['is_joined']) {
                    $previousMeritStatus = [
                        'is_stay' => $currentIsStay,
                        'is_joined' => $currentIsJoined,
                    ];
                    return true;
                }
                $previousMeritStatus = [
                    'is_stay' => $currentIsStay,
                    'is_joined' => $currentIsJoined,
                ];
                return false;
            });
        $this->isStayOrUpgraded = auth()->user()->meritlistfromcollege?->contains('is_stay', true);
        $this->isStay = auth()->user()->meritlistfromcollege?->contains('is_stay', true);
        $this->selectionList = SelectionList::where('status', 1)
            ->latest()
            ->with(['meritListFromCollege' => function ($query) {
                $query->where('user_id', auth()->user()->id);
            }])
            ->first();

        // if (isset($this->selectionList) && isset($this->selectionList->meritListFromCollege) && count($this->selectionList->meritListFromCollege) > 0) {
        //     $this->selectedCollegeId = $this->selectionList?->meritListFromCollege[0]?->college?->id;
        // }

        $selectionListIds = SelectionList::where('status', 1)
            ->pluck('id')
            ->toArray();

        $checkList = MeritListFromCollege::where('user_id', auth()->user()->id)
            ->whereIn('selection_list_id', $selectionListIds)
            ->get();

        $this->isOpenMerit = $checkList->contains('seat_id', 1);
        $this->isOversease = $checkList->contains('seat_id', 2);

        $this->selectedCollegeId = MeritListFromCollege::where('user_id', auth()->user()->id)
            ->whereIn('selection_list_id', $selectionListIds)
            ->latest()
            ->value('college_to');

        if ($this->isStay) {
            $this->selectedCollegeId = MeritListFromCollege::where('user_id', auth()->user()->id)
                ->where('is_stay', 1)
                ->first()?->college_to;
        }

        if (auth()->user()->otps && auth()->user()->otps->is_verified == 1) {
            auth()->user()->otps->update([
                'is_verified' => 0,
            ]);
        }
        $this->personalDetails = auth()->user()->personalDetails;
        $this->image = Storage::disk('public')->url(auth()->user()->image->path);

        /*if (auth()->user()->userAdmissionChallanImage) {
            $this->admissionChallan = $this->getImageUrl(auth()->user()->userAdmissionChallanImage->path);
        }

        $this->challanStatus(auth()->user()->challan_id);
        $this->admissionChallanStatus(auth()->user()->admission_challan_id);*/
        $this->seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();
        $this->isJoined = auth()->user()->meritlistfromcollege?->contains('is_joined', true);

        if(boolval($this->isStayOrUpgraded)){
            $college_from = '';
            $merit_list_college = \App\Models\MeritListFromCollege::query()
                ->where('user_id',auth()->user()->id)
                ->where('is_stay',1)
                ->first();
            $college_to = \App\Models\College::where('id',$this->selectedCollegeId)->first();
        } else {
            $merit_list_college =
                isset($selectionList->meritListFromCollege) && count($selectionList->meritListFromCollege) > 0
                    ? $selectionList->meritListFromCollege[0]
                    : '';
            $college_from =
                isset($selectionList->meritListFromCollege) && count($selectionList->meritListFromCollege) > 0
                    ? $selectionList->meritListFromCollege[0]->college_from
                    : '';
            $college_to =
                isset($selectionList->meritListFromCollege) && count($selectionList->meritListFromCollege) > 0
                    ? $selectionList->meritListFromCollege[0]->college
                    : '';
        }

        if ($this->selectedCollegeId > 0) {
            $path = MeritListFromCollege::where('college_to', $this->selectedCollegeId)
                ->where('user_id', auth()->user()->id)
                ->first();
            if(auth()->user()->selection_seat_id == 1){
                $path = MeritListFromCollege::where('user_id', auth()->user()->id)
                    ->whereIn('selection_list_id', $selectionListIds)
                    ->where('seat_id', 1)
                    ->first();
            }
            if(auth()->user()->selection_seat_id == 2){
                $path = MeritListFromCollege::where('user_id', auth()->user()->id)
                    ->whereIn('selection_list_id', $selectionListIds)
                    ->where('seat_id', 2)
                    ->first();
            }

            /*auth()->user()->meritListFromCollege()
                ->where('college_to', $this->selectedCollegeId)
                ->update([
                    'student_affidavit_path' => $path,
                    'is_joined' => 1,
                ]);*/
            $this->filePath = $path->student_affidavit_path;
            $this->fileName = "student_report";
        }

        $this->is_Stayed = MeritListFromCollege::where('user_id', auth()->user()->id)
            ->where('is_stay', 1)
            ->exists();

        $this->is_Upgraded = MeritListFromCollege::where('user_id', auth()->user()->id)
            ->where('is_stay', 0)
            ->where('is_joined', 1)
            ->exists();

        /*$this->sameCollege = MeritListFromCollege::where('user_id', auth()->user()->id)
            ->whereIn('selection_list_id',$selectionListIds)
            ->where('is_stay', 0)
            ->whereColumn('college_from', 'college_to')
            // ->where('student_affidavit_path', '!=', null)
            ->latest()
            ->exists();*/
    }

    /**
     * @param $path
     * @return string
     */
    private function getImageUrl($path): string
    {
        return Storage::disk('public')->url($path);
    }

    public function redirectToOTPVerification()
    {
        $otp = $this->generateOTP();

        $userId = auth()->user()->id;
        $otpType = OtpTypes::EMAIL;
        $otpReason = OtpReasons::EDITFORM;
        $phone_number = auth()->user()->personalDetails->mobile_number;

        $message = "Your UHS Online Admission Portal OTP is " . $otp . ". Never share this OTP with anyone. Regards UHS.";
        $this->userServices->updateOrCreateOTP($userId, $otp, $otpType, $otpReason);
        $this->sendSms($phone_number, $message);
        dispatch(new SendOtpEmail(auth()->user()->email, $otp));

        return redirect()->route('uhs-form-otp');
    }

    public function generateOTP()
    {
        return rand(1000, 9999); // Generates a 4-digit OTP
    }

    public function submit()
    {
        $this->validate();
        $userId = auth()->user()->id;
        $meritList = auth()->user()->meritlistfromcollege;

        $this->validate();

        // if (!is_string($this->challan)) {
        //     $this->mediaServices->updateOrCreateUserProfileImage([
        //         'id' => auth()->user()->userChallanImage?->id
        //     ], $this->formatImageData($this->challan, 'userChallanImage'));

        //     $this->emit('challanUploaded');
        // }

        if (!is_string($this->admissionChallan)) {

            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->userAdmissionChallanImage?->id,
            ], $this->formatImageData($this->admissionChallan, 'userAdmissionChallanImage'));
            $this->emit('challanUploaded');
        }

        $this->emit('$refresh');
        $this->emit('openModal', 'uhs-forms.modal.image-submitted-successfully');
        //        $this->challanSubmitted = true;
    }

    public function submitAffidavit()
    {
        if($this->isOpenMerit && $this->isOversease && auth()->user()->selection_seat_id == 0){
            $this->validate([
                'seatCategory' => 'required',
            ]);
        }

        $this->validate([
            'studentAffidavit' => 'required',
        ]);


        if(($this->seatCategory && $this->seatCategory == 'Open Merit') || auth()->user()->selection_seat_id == 1){
            $activeSelectionListIds = SelectionList::where('status', 1)->pluck('id')->toArray();
            if (isset($this->studentAffidavit)) {
                $path = $this->studentAffidavit->store(auth()->user()->id . '_images/student-report', 'public');
                auth()->user()->meritListFromCollege()
                    ->whereIn('selection_list_id',$activeSelectionListIds)
                    ->where('seat_id',1)
                    // ->where('college_to', $this->selectedCollegeId)
                    ->update([
                        'student_affidavit_path' => $path,
                    ]);
            }
            auth()->user()->meritListFromCollege()
                ->whereIn('selection_list_id',$activeSelectionListIds)
                ->where('seat_id',1)
                // ->where('college_to', $this->selectedCollegeId)
                ->update([
                    'is_joined' => 1,
                    'is_stay' => $this->isStayOrUpgraded,
                ]);

            auth()->user()->update([
                'selection_seat_id' => 1
            ]);
            $this->emit('challanUploaded');
            return;
        }
        if(($this->seatCategory && $this->seatCategory == 'Overseas') || auth()->user()->selection_seat_id == 2){
            $activeSelectionListIds = SelectionList::where('status', 1)->pluck('id')->toArray();
            if (isset($this->studentAffidavit)) {
                $path = $this->studentAffidavit->store(auth()->user()->id . '_images/student-report', 'public');
                auth()->user()->meritListFromCollege()
                    ->whereIn('selection_list_id',$activeSelectionListIds)
                    ->where('seat_id',2)
                    // ->where('college_to', $this->selectedCollegeId)
                    ->update([
                        'student_affidavit_path' => $path,
                    ]);
            }
            auth()->user()->meritListFromCollege()
                ->whereIn('selection_list_id',$activeSelectionListIds)
                ->where('seat_id',2)
                // ->where('college_to', $this->selectedCollegeId)
                ->update([
                    'is_joined' => 1,
                    'is_stay' => $this->isStayOrUpgraded,
                ]);
            auth()->user()->update([
                'selection_seat_id' => 2
            ]);
            $this->emit('challanUploaded');
            return;
        }

        if (isset($this->studentAffidavit)) {
            if ($this->selectedCollegeId > 0) {
                $path = $this->studentAffidavit->store(auth()->user()->id . '_images/student-report', 'public');
                $activeSelectionListIds = SelectionList::where('status', 1)->pluck('id')->toArray();
                auth()->user()->meritListFromCollege()
                    ->where('college_to', $this->selectedCollegeId)
                    ->whereIn('selection_list_id',$activeSelectionListIds)
                    ->update([
                        'student_affidavit_path' => $path,
                        'is_joined' => 1,
                    ]);
            }
        }
        if ($this->isStayOrUpgraded) {
            if ($this->selectedCollegeId > 0) {
                $activeSelectionListIds = SelectionList::where('status', 1)->pluck('id')->toArray();
                auth()->user()->meritListFromCollege()
                    ->where('college_to', $this->selectedCollegeId)
                    ->whereIn('selection_list_id',$activeSelectionListIds)
                    ->update([
                        'is_stay' => $this->isStayOrUpgraded,
                    ]);
            }
        }
        $this->emit('challanUploaded');

    }


    /**
     * @param $image
     * @param $collection
     * @return array
     */
    /*private function formatImageData($image, $collection): array
    {
    return [
    'imageName'  =>  $collection . '.' . $image->extension(),
    'imagePath'  => $image->storeAs(auth()->user()->id . '_images', $collection . '.' . $image->extension(), 'public'),
    'imageSize'  => $image->getSize(),
    'userId'     => auth()->user()->id,
    'model'      => User::class,
    'disk'       => "public",
    'collection' => $collection,
    ];
    }*/

    public function formatImageData($image, $collection): array
    {
        $newWidth = 700;
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
        $sourcePath = $image?->getRealPath();
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
            'imageName' => $collection . '.' . $extension,
            'imagePath' => $storagePath,
            'imageSize' => filesize($imagePath),
            'userId' => auth()->user()->id,
            'model' => User::class,
            'disk' => 'public',
            'collection' => $collection,
        ];
    }

    private function generateUniqueNumber(): int
    {
        $number = 423562;

        return $number + auth()->user()->id;
    }

    private function generateAdmissionUniqueNumber(): int
    {
        $number = 4235621;

        return $number + auth()->user()->id;
    }

    /**
     * @return StreamedResponse
     */
    public function downloadChallan(): StreamedResponse
    {
        $challanAmount = auth()->user()->program_id == 3 ? 4082 : 2082;

        // Update the 'challan_amount' column in the 'users' table
        $this->userServices->updateUser([
            'challan_amount' => $challanAmount,
        ], auth()->user()->id);

        $this->userServices->updateUser([
            'challan_id' => $this->generateUniqueNumber(),
        ], auth()->user()->id);

        $data = [
            'title' => 'Sample PDF',
            'cnic' => $this->personalDetails->cnic_passport,
            'name' => auth()->user()->name,
            'fatherName' => auth()->user()->father_name,
            'challanId' => $this->generateUniqueNumber(),
            'programId' => auth()->user()->program_id,
        ];

        $pdfContent = PDF::loadView('livewire.pdf.challan', $data)->output();

        return response()->streamDownload(
            function () use ($pdfContent) {
                return print($pdfContent);
            },
            "Challan-Form.pdf"
        );
    }

    /**
     * @return StreamedResponse
     */
    public function downloadAdmissionChallan()
    {
        return redirect()->route('download.challan', [config('envdata.admission_challan_type_id'), true]);
        // $challanAmount =  18112;
        // $userId = auth()->user()->id;
        // $challanId = $this->generateAdmissionUniqueNumber();
        // $collegeName = auth()->user()->meritListDetail->college_name;
        // $challanType= "Admission";
        // $challanDueDate = Carbon::createFromFormat('m-d-Y', '12-20-2023');
        // $this->userServices->updateOrCreateAdmission($userId,  $challanId, $challanAmount,$collegeName, $challanType,$challanDueDate);
        // $data = [
        //     'title' => 'Challan Pdf',
        //     'cnic' => $this->personalDetails->cnic_passport,
        //     'name' => auth()->user()->name,
        //     'fatherName' => auth()->user()->father_name,
        //     'challanId' => $this->generateAdmissionUniqueNumber(),
        //     'programId'  => auth()->user()->program_id,
        // ];

        // $pdfContent = PDF::loadView('livewire.pdf.challanTwo', $data)->output();

        // return response()->streamDownload(
        //     function () use ($pdfContent) {
        //         return print($pdfContent);
        //     },
        //     "Challan-Form.pdf"
        // );
    }

    private function challanStatus($id)
    {
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
    }

    private function admissionChallanStatus($id)
    {
        if (isset($id) && !empty($id)) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'content-type' => 'application/json',
            ])->get('https://fms.uhs.edu.pk/login/get_challan_status/' . base64_encode($id));

            $status = $response->getbody()->getContents();
            if ($status == 1) {
                $this->admissionChallanStatus = true;
                auth()->user()->update([
                    'admission_is_paid' => 1,
                ]);
                return true;
            }
            if ($status == 0) {
                $this->admissionChallanStatus = false;
                return false;
            }
            return false;
        }
        return false;
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
