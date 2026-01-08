<div class="bg-cover bg-center min-h-screen mt-5 mb-5 rounded-xl" style="background-image: url('{{asset('images/new-bg-blue.png')}}');">
    <div class="flex flex-col gap-3 items-center justify-center h-screen">
       {{-- <div class="bg-white rounded-lg shadow-md p-4" style="width: 500px; color:red; box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.3);">
            <h2 class="text-xl font-inter text-center font-semibold mb-4">You need to upload the Documents in Documents Upload Screen if you edit the form.</h2>    
        </div>--}}
    <div class="bg-white rounded-lg shadow-md p-8" style="width: 500px; box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.3);">
            <h2 class="text-2xl font-inter font-semibold mb-4">Verification Code</h2>
            <p class="mb-5 font-inter">Please enter the 4-digit verification code that was sent to <strong>{{ auth()->user()->email }}</strong>
               {{-- and your provided phone number <strong>{{ auth()->user()->mobile_number }}</strong>--}}. The code is valid for 10 minutes.</p>

            <!-- Input for OTP -->
            <div class="flex justify-center mb-4">
                <input type="text" wire:model="otpEntered" maxlength="4" class="border p-2 rounded mr-2" />
            </div>

            <!-- Resend and Verify Buttons -->
            <div class="flex justify-center">
                <button type="button" class="bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 px-4 rounded mr-2" wire:click="reSendOTPVerification">Resend</button>
                <button type="submit" wire:click="verifyOTP" class="bg-blue-500 hover:bg-5345ff-700 text-white font-semibold py-2 px-4 rounded">Verify</button>
            </div>
           
            @if ($isOtpExpired)
            <div class="text-red-500 mt-4 text-center">OTP has expired. Please request a new OTP.</div>
            @endif
          
            @error('otpEntered')
                <div class="text-red-500 mt-4 text-center">{{ $message }}</div>    
            @enderror

            <script>
                Livewire.on('otpVerified', () => {
                    alert('OTP has been verified successfully.');
                    window.location.href = "{{ route('uhs-form') }}";
                });

                Livewire.on('otpReSent', () => {
                    alert('New OTP has been sent to your email.');
                });
            </script>
        
        </div>
    </div>
</div>