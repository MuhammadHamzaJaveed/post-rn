<?php

namespace App\Http\Livewire\UhsForms;

use App\Enums\Status\Status;
use App\Jobs\SendOtpEmail;
use App\Models\User;
use App\Traits\SmsApi;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OTPNotification;
use App\Models\OTPS;
use App\Enums\Otp\OtpReasons;
use App\Enums\Otp\OtpTypes;
use App\Services\UserServices\UserServices;

class Otp extends Component
{
    use SmsApi;
    public $otpEntered;

    protected $userServices;

    public $isOtpExpired = false;


    protected $rules = [
        'otpEntered' => 'required',
    ];


     /**
     * Summary of boot
     * @param  UserServices  $userServices
     * @return void
     */
    public function boot(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function verifyOTP()
    {
        $this->validate();

        $user = auth()->user();

        if (auth()->user()->otps->sent_at->addMinutes(10)->isPast()) {
            $this->isOtpExpired = true;               
        } elseif ($user->otps->value == $this->otpEntered) {
            $this->emit('otpVerified');
            auth()->user()->otps->update([
                'is_verified' => 1,
            ]);

            if (auth()->user()->status != Status::REJECTED)
            {
                auth()->user()->update([
                        'status' => Status::REJECTED
                    ]
                );
            }

            auth()->user()->update([
                    'edit_user_status' => Status::UNVERIFIED
                ]
            );
    
        } else {
            $this->addError('otpEntered', 'Incorrect OTP. Please try again.');
        }

    }

    public function reSendOTPVerification()
    {
        $otp = $this->generateOTP();

        $userId = auth()->user()->id; 
        $otpType = OtpTypes::EMAIL; 
        $otpReason = OtpReasons::EDITFORM; 
    
        $this->userServices->updateOrCreateOTP($userId, $otp, $otpType, $otpReason);
        dispatch(new SendOtpEmail(auth()->user()->email, $otp));
      /*  $phone_number = auth()->user()->personalDetails->mobile_number;
        $message= "Your new UHS Online Admission Portal OTP is ".$otp.". Never share this OTP with anyone. Regards UHS.";
        $this->sendSms($phone_number, $message);*/
        $this->isOtpExpired = false;
        $this->emit('otpReSent');
        
    }

    public function generateOTP()
    {
        return rand(1000, 9999); // Generates a 4-digit OTP
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('livewire.uhs-forms.otp')
            ->extends('layouts.uhs-form')
            ->section('content');
    }
}
