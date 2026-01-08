<?php

namespace App\Http\Livewire\CreateEditUserProfile;

use Illuminate\Contracts\Foundation\Application;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use App\Services\UserServices\UserServices;
use App\Services\MediaServices\MediaServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Department;

class CreateEditUserProfile extends ModalComponent
{
    use WithFileUploads;

    protected $userServices;

    protected $mediaServices;
 
    public $image;

    public $name;

    public $surname;

    public $email;

    public $user;

    public $storedUserProfileImagePath ;

    public $allDepartment;

    public $department;

    public $imageId;

    /**
     * @return array
     */
    protected function rules(): array
    {
            return [
                'name'    => 'required',
                'surname' => 'required',
                'email'   => ['required', 'email', Rule::unique('users')->ignore($this->user ? $this->user->id : '')],
                'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            ];
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

    /**
     * @return void
     */
    public function mount()
    {
        $this->allDepartment = Department::all();

        $this->user = $this->userServices->findOneUserById(auth()->user()->id)[0];
        $this->name             = $this->user->name;
        $this->surname          = $this->user->surname;
        $this->email            = $this->user->email;
        $this->department       = (string)$this->user->department_id;

        if($this->user->image) {
            $this->imageId = $this->user->image->id;
        }
    }

    /**
     * @return void
     */
    public function updatedImage()
    {
        $this->validate();
    }

    /**
     * @return Application|Redirector|RedirectResponse
     */
    public function submit()
    {
        $this->validate();

        if($this->department)
        {
            $data["department_id"] = (integer)$this->department;
        } else {
            $data["department_id"] = null;
        }

        if ( $this->image )
        {
            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => $this->imageId
            ], $this->formatImageData());
        }
        
        $this->user = $this->userServices->updateUser($data, $this->user->id);
        $message = "The user profile has been updated successfully";

        Session::flash(
            'primary',
            $message
        );

        return redirect(route('user-details'));
    }

    function formatImageData(){
        return [
            'imageName' => time() . '_' . Str::random(8) . '.' . $this->image->extension(),
            'imagePath' => $this->image->store('images', 'public'),
            'imageSize' => $this->image->getSize(),
            'userId'    => $this->user->id,
            'model'     => User::class,
            'disk'      => $this->image->disk,
        ];
    }

    public function render()
    {
        $userImages = $this->user->image()->first();

        if ( $userImages ) {
            $storedUserProfileImagePath = $userImages->path;
            $this->storedUserProfileImagePath = $storedUserProfileImagePath;
        } else {
            $storedUserProfileImagePath = "";
        }
            
        return view('livewire.createedituserprofile.create-edit-user-profile',
            compact('storedUserProfileImagePath'))
            ->extends('layouts.app')
            ->section('content');
    }
}
