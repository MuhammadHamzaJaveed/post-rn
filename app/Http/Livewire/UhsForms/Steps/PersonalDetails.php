<?php

namespace App\Http\Livewire\UhsForms\Steps;

use App\Models\User;
use App\Models\PersonalDetail;
use App\Services\MediaServices\MediaServices;
use App\Services\UserServices\UserServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class PersonalDetails extends Component
{
    use WithFileUploads;

    protected $userServices;

    protected $mediaServices;

    public $image;

    public $genderId;

    public $residenceId;

    public $nationalityId;

    public $nationalityID;


    public $name;

    public $motherName;

    public $fatherName;

    public $dob;

    public $mobileNumber;

    public $secondaryNumber;

    public $showInput = 0;

    public $telephoneNumber;


    public $email;


    public $address;


    public $domicile;


    public $cnic;

    public $country;


    public $city;


    public $cnic_passport;


    public $seatCategories = [];


    /**
     * @return array
     */
    protected function rules(): array
    {
        $requiredRules = [
            'name'            => 'required|regex:/^[A-Za-z\s\-\.]+$/',
            'motherName'      => 'required|regex:/^[A-Za-z\s\-\.]+$/',
            'dob'             => 'required',
            'mobileNumber'    => 'required|numeric',
            'telephoneNumber' => 'nullable|numeric',
            'email'           => 'required|email',
            'genderId'        => 'required',
            'residenceId'     => 'required',
            'address'         => 'required',
            'secondaryNumber' => 'nullable|numeric',
            'city'            => 'required|regex:/^[A-Za-z\s\-]+$/',
            'country'         => 'required|regex:/^[A-Za-z\s\-]+$/',
            'cnic'            => 'required',

            'image' => [
                'bail',
                'required',
                Rule::when(
                    !is_string($this->image),
                    [
                        'mimes:jpeg,png,jpg,gif',
                        'max:1024' // Adjusted to 1MB
                    ]
                ),
            ],
        ];

        if($this->showInput ==1)
        {
            $requiredRules += [
                'cnic_passport'   => 'required|size:13',
            ];
        }
        if($this->showInput ==2)
        {
            $requiredRules += [
                'cnic_passport'   => 'required|size:13',
            ];
        }

        if($this->showInput ==3)
        {
            $requiredRules += [
                'cnic_passport'   => 'required|size:13',
            ];
        }

        if($this->showInput ==4)
        {
            $requiredRules += [
                'cnic_passport'   => 'required|size:9',
            ];
        }

        if($this->showInput ==5)
        {
            $requiredRules += [
                'cnic_passport'   => 'required|size:9',
            ];
        }

        if($this->showInput ==6)
        {
            $requiredRules += [
                'cnic_passport'   => 'required|size:13',
            ];
        }

        if (auth()->user()->foreigner == 0) {
            $requiredRules += [
                'domicile'      => 'required',
            ];
        }
        if (auth()->user()->foreigner == 1) {
            $requiredRules += [
                'nationalityId'   => 'required',
            ];
        }

        return $requiredRules;
    }


    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    /**
     * Summary of boot
     * @param  UserServices  $userServices
     * @param  MediaServices  $mediaServices
     * @return void
     */
    public function boot(UserServices $userServices, MediaServices $mediaServices)
    {
        $this->userServices = $userServices;
        $this->mediaServices = $mediaServices;
    }

    public function messages(): array
    {
        return [
            'image.max' => 'Please upload an image smaller than 1MB.',
        ];
    }

    public function mount()
    {
        $user= auth()->user();
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->mobileNumber = auth()->user()->mobile_number;
        $this->fatherName = auth()->user()->father_name;
        $personalDetails = auth()->user()->personalDetails;
        $this->cnic = $user->cnic_passport_id;
        $this->genderId = auth()->user()->seat_id;
        $this->cnic_passport = $user->cnic_passport;
        $this->seatCategories = auth()->user()->seatCategories->pluck('id')->toArray();
        if (auth()->user()->image) {
            $this->image = Storage::disk(auth()->user()->image->disk)->url(auth()->user()->image->path);
        }

        switch ($user->cnic_passport_id) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
                $this->showInput = $user->cnic_passport_id;
                break;
        }

        if ($personalDetails) {
            $this->motherName = $personalDetails->mother_name;
            $this->dob = $personalDetails->date_of_birth;
            $this->mobileNumber = $personalDetails->mobile_number;
            $this->secondaryNumber = $personalDetails->secondary_number;
            $this->telephoneNumber = $personalDetails->telephone_number;
//            $this->genderId = $personalDetails->gender_id;
            $this->residenceId = $personalDetails->residence_area_id;
            $this->address = $personalDetails->address;
            $this->domicile = $personalDetails->district_id;
            $this->nationalityId = $personalDetails->nationality_id;
            $this->city = $personalDetails->city;
            $this->country = $personalDetails->country;
            $this->showInput = $personalDetails->showInput;
        }
    }

    public function deleteImage()
    {
        $this->image = null;
    }

    /**
     * Summary of getAllUsersProperty
     * @return mixed
     */
    public function getAllGendersProperty()
    {
      return  $this->userServices->getAllGenders()->where('id',auth()->user()->seat_id);
    }

    /**
     * Summary of getAllUsersProperty
     * @return mixed
     */
    public function getAllResidenceAreasProperty()
    {
        return $this->userServices->getAllResidenceAreas();
    }

    /**
     * Summary of getAllUsersProperty
     * @return mixed
     */
    public function getAllNationalitiesProperty()
    {
        return $this->userServices->getAllNationalities();
    }

    /**
     * Summary of getAllUsersProperty
     * @return mixed
     */
    public function getAllDomicileDistrictsProperty()
    {
        return $this->userServices->getAllDomicileDistricts();
    }

    /**
     * Summary of getAllCnicPassportProperty
     * @return mixed
     */
    public function getAllCnicPassportProperty()
    {
        $cnicPassportOptions = $this->userServices->getAllCnicPassport()->toArray();

        if (auth()->user()->foreigner == 0) {
            $cnicPassportOptions = array_slice($cnicPassportOptions, 0, 3);
        } elseif (auth()->user()->foreigner == 1) {
            $cnicPassportOptions = array_slice($cnicPassportOptions, 0, 6);
        }
        return $cnicPassportOptions;
    }

    public function submit()
    {
        $this->validate();
        $personalDetails = $this->userServices->updateOrCreatePersonalDetails(
            [
                'id' => auth()->user()->personalDetails?->id,
            ],
            $this->formatPersonalDetailsInfo()
        );

        PersonalDetail::where('user_id', auth()->user()->id)->update(['showInput' => $this->cnic]);

        $this->userServices->updateUser([
            'name'               => $this->name,
            'personal_detail_id' => $personalDetails->id,
            'father_name'        => $this->fatherName
        ], auth()->user()->id);

        if (!is_string($this->image)) {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => auth()->user()->image?->id
            ], $this->formatImageData());
        }
        $this->emit('refreshTopNavBar');
        $this->emit('completeStep', 'step2Completed');
        $this->emit('goToStep', 3);
    }

    /*public function updatedCnic($value)
    {
        if ($value === 1) {
            $this->showInput = 1;
        } else if ($value === 2) {
            $this->showInput = 2;
        } else if ($value === 3) {
            $this->showInput = 3;
        } else if ($value === 4) {
            $this->showInput = 4;
        } else if ($value === 5) {
            $this->showInput = 5;
        } else if ($value === 6) {
            $this->showInput = 6;
        } else {
            $this->showInput = 0;
        }
        $this->reset('cnic_passport');
    }*/
    /**
     * @return array
     */
    private function formatImageData(): array
    {
        return [
            'imageName'  => time() . '_' . Str::random(8) . '.' . $this->image->extension(),
            /*'imagePath'  => 'NFS-UHSP/'.$this->image->store(auth()->user()->name . '_' . auth()->user()->id . '_images', 'public'),*/
            'imagePath'  => $this->image->store(auth()->user()->name . '_' . auth()->user()->id . '_images', 'public'),
            'imageSize'  => $this->image->getSize(),
            'userId'     => auth()->user()->id,
            'model'      => User::class,
            'disk'       => 'public',
            'collection' => 'avatar',
        ];
    }

    /**
     * @return array
     */
    private function formatPersonalDetailsInfo(): array
    {
        return [
            'user_id'           => auth()->user()->id,
            'mother_name'       => $this->motherName,
            'date_of_birth'     => $this->dob,
            'mobile_number'     => $this->mobileNumber,
            'telephone_number'  => $this->telephoneNumber,
            'gender_id'         => $this->genderId,
            'residence_area_id' => $this->residenceId,
            'address'           => $this->address,
            'district_id'       => $this->domicile,
            'cnic_passport'     => auth()->user()->cnic_passport,
            'cnic_passport_id'  => auth()->user()->cnic_passport_id,
            'nationality_id'    => $this->nationalityId,
            'secondary_number'  => $this->secondaryNumber,
            'city'              => $this->city,
            'country'           => $this->country,

        ];
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.personal-details');
    }
}
