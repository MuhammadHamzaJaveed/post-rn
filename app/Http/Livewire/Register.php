<?php

namespace App\Http\Livewire;

use App\Services\UserServices\UserServices;
use Livewire\Component;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Jobs\SendEmail;

class Register extends Component
{
    protected $userServices;

    public $name;

    public $father_name;

    public $mobile_number;

    public $email;

    public $password;

    public $password_confirmation;

    public $role_name;

    public $user;

    public $foreigner = 0;
    public $cnic_passport;
    public $showInput = 0;
    public $cnic;

    /**
     * @return array
     */
    protected function rules(): array
    {

        $requiredRules = [
            'name' => 'required|regex:/^[A-Za-z\s\-]+$/',
            'father_name' => 'required|regex:/^[A-Za-z\s\-]+$/',
            'mobile_number' => 'required|numeric',
            'email' => [
                'required',
                'email',
                'regex:/^[\w\.-]+@[\w\.-]+\.[cC][oO][mM]$/',
                Rule::unique('users')->ignore($this->user ? $this->user->id : '')
            ],
            'password' => 'required | min:8',
            'password_confirmation' => 'required_with:password|same:password',
            'cnic' => 'required',
            /*'foreigner' => 'required',*/
        ];

        if ($this->showInput == 1) {
            $requiredRules += [
                'cnic_passport' => 'required|size:13|unique:users,cnic_passport',
            ];
        }
        if ($this->showInput == 2) {
            $requiredRules += [
                'cnic_passport' => 'required|size:13|unique:users,cnic_passport',
            ];
        }

        if ($this->showInput == 3) {
            $requiredRules += [
                'cnic_passport' => 'required|size:13|unique:users,cnic_passport',
            ];
        }

        if ($this->showInput == 4) {
            $requiredRules += [
                'cnic_passport' => 'required|size:9|unique:users,cnic_passport',
            ];
        }

        if ($this->showInput == 5) {
            $requiredRules += [
                'cnic_passport' => 'required|size:9|unique:users,cnic_passport',
            ];
        }

        if ($this->showInput == 6) {
            $requiredRules += [
                'cnic_passport' => 'required|size:13|unique:users,cnic_passport',
            ];
        }

        return $requiredRules;


        /*return [
            'name'                  => 'required|regex:/^[A-Za-z\s\-]+$/',
            'father_name'           => 'required|regex:/^[A-Za-z\s\-]+$/',
            'mobile_number'         => 'required|numeric',
            'email'                 => [
                'required', 'email',
                Rule::unique('users')->ignore($this->user ? $this->user->id : '')
            ],
            'password'              => 'required | min:8',
            'password_confirmation' => 'required_with:password|same:password',
            'cnic'            => 'required',
        ];*/
    }

    public function getAllCnicPassportProperty()
    {
        /*$cnicPassportOptions = $this->userServices->getAllCnicPassport()->toArray();

        if ($this->foreigner == 0) {
            $cnicPassportOptions = array_slice($cnicPassportOptions, 0, 3);
        } elseif ($this->foreigner == 1) {
            $cnicPassportOptions = array_slice($cnicPassportOptions, 0, 6);
        }*/
        return $this->userServices->getAllCnicPassport()->toArray();
    }

    public function updatedCnic($value)
    {
        if ($value === 1) {
            $this->showInput = 1;
        } else {
            if ($value === 2) {
                $this->showInput = 2;
            } else {
                if ($value === 3) {
                    $this->showInput = 3;
                } else {
                    if ($value === 4) {
                        $this->showInput = 4;
                    } else {
                        if ($value === 5) {
                            $this->showInput = 5;
                        } else {
                            if ($value === 6) {
                                $this->showInput = 6;
                            } else {
                                $this->showInput = 0;
                            }
                        }
                    }
                }
            }
        }
        $this->reset('cnic_passport');
    }

    /**
     * @return void
     */
    public function mount()
    {
        /*return redirect(route('login'))->with('message', 'Registration Closed');*/
        $this->role_name = 'Guest';
    }

    /**
     * Summary of boot
     * @param  UserServices  $userServices
     * @return void
     */
    public function boot(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function submit()
    {
        $userData = $this->validate();
        $userData['cnic_passport_id'] = $this->cnic;
        unset($userData['password_confirmation']);
        $userData['password'] = Hash::make($this->password);
        $userData['plain_password'] = $this->password;
        $this->user = $this->userServices->createUser($userData);
        $message = "We have sent you an email. Please verify your Email address to Login";

        try {
            $this->user->sendEmailVerificationNotification();
        } catch (\Exception $e) {
           \Log::channel('email')->error('Failed to send email.', [
                'error' => $e->getMessage(),
            ]);
        }

        $this->user->assignRole($this->role_name);

        Session::flash(
            'primary',
            $message
        );

        return redirect(route('login'));
    }

    /**
     * @return Application|Factory|View
     */

    public function render()
    {
        return view('livewire.register')
            ->extends('layouts.register-user')
            ->section('content');
    }
}
