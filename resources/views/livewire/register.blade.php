{{-- new form --}}

<div style="background-image: url('{{asset('images/new-bg-blue.png')}}');"
     class="bg-cover bg-center min-h-screen flex items-center justify-center">
    <form wire:submit.prevent="submit">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-center pb-5" style="padding-top: 70px">
            <div class="flex flex-col items-center justify-center">
                <div class="flex flex-col justify-center items-center px-4 md:px-8 mb-10 md:mb-1">
                    <div class="flex flex-row justify-start ">
                        <img src="{{ asset('images/privateclogo.png') }}" alt="Login Image"
                             class="rounded-lg w-20 h-20">
                        <div style="margin-right: 176px"></div> <!-- Add space here -->
                        <img src="{{ asset('images/login.png') }}" alt="Login Image" class="w-20 h-20">
                    </div>
                    <p class="text-white text-center font-poppins text-base lg:text-lg font-semibold tracking-normal pt-4">
                         Online Admission Application Portal for Post RN BSc Nursing (2 Years Degree Program)<br/>
                        in Public Sector Nursing Colleges of Punjab<br/>
                    </p>
                    <p class="text-white font-poppins tracking-wide">Session {{config('envdata.pdf_session')}}</p>
                    <p class="text-white text-center font-poppins text-base lg:text-lg font-semibold tracking-normal pt-4">
                        University of Health Sciences (UHS), Lahore<br/>
                        Specialized Healthcare & Medical Education Department (SH&MED)<br/>
                        Government of the Punjab
                    </p>
                    <div class="flex flex-col mt-5 items-center justify-center p-5 w-96 bg-white rounded-lg shadow-xl md:p-9">
                        <p class="text-2xl text-red-600 font-bold mb-3">Read Carefully</p>

                        <p class="text-black font-medium text-lg flex flex-row"><span
                                    class="text-blue-900  pr-3">
                                <x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                                    </span> Before signing up, please note that once your account is created, you
                            will not be able to change your E-Mail ID.
                        </p>
                        <p class="text-black font-medium text-lg flex flex-row"><span
                                    class="text-blue-900  pr-3">
                                <x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                                    </span> Make sure to register with a valid phone number that will be
                            accessible throughout the admission process.
                        </p>

                    </div>
                </div>

            </div>
            <div class="flex justify-center lg:justify-end items-center mt-7 lg:mt-0 lg:pr-10">
                <div class="bg-white px-6 py-10 md:px-10 md:py-10 rounded-xl">
                    <x-jet-validation-errors class="mb-4"/>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-blue-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('message'))
                        <div class="mb-4 font-medium text-sm text-red-600">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="mb-8">
                        <p class="font-poppins font-bold text-2xl text-black text-center">Register here</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <span>
                            <label class="text-sm">Full Name <span
                                        class="text-red-600">*</span></label>
                        <x-input id="name" placeholder="Enter Full name" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name"
                                 wire:model.defer="name" style="box-shadow: none"/>
                        </span>
                        <span>
                            <label class="text-sm">Father/Guardian Name <span
                                        class="text-red-600">*</span></label>
                            <x-input id="father_name"  placeholder="Enter Father/Guardian name"
                                     type="text" required
                                     name="father_name" wire:model.defer="father_name" style="box-shadow: none"/>
                        </span>
                    </div>
                    <div class="mt-5">
                        <span>
                            <label class="text-sm">Local Mobile Number <span
                                        class="text-red-600">*</span></label>
                            <x-inputs.maskable mask="['####-#######']" id="mobile_number" placeholder=" 03XX-XXXXXX"
                                               name="mobile_number"
                                               required wire:model.defer="mobile_number"/>
                        </span>
                    </div>
                    <div class="mt-5">
                        <span>
                            <label class="text-sm">Email address <span
                                        class="text-red-600">*</span></label>
                            <x-input id="email" placeholder=" Enter email" type="email" name="email"
                                     :value="old('email')" required wire:model.defer="email"/>
                        </span>
                    </div>

                    <div class="mt-5">
                        <label class="text-sm">Select CNIC/POC/Passport/B-Form <span
                                    class="text-red-600">*</span></label>
                        <x-select placeholder="Please Select CNIC/POC/Passport/B-Form " required :options="$this->allCnicPassport" wire:model="cnic" option-value="id" option-label="name"
                                  style="padding: 7px 2px; box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />
                    </div>


                        @if ($showInput === 1)
                            <!-- Non-Foreigner CNIC -->
                            <div class="mt-5">
                                <label class="text-sm ">Enter CNIC <span
                                            class="text-red-600">*</span></label>
                                <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter CNIC without dashes"
                                         wire:model.defer="cnic_passport"
                                         class="py-2 px-3 shadow-none outline-none align-middle " type="number"
                                         style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />
                            </div>
                        @elseif ($showInput == 2)
                            <!-- Non-Foreigner B-Form -->
                            <div class="mt-5">
                                <label class="text-sm ">Enter B-Form <span
                                            class="text-red-600">*</span></label>
                                <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter B-Form without dashes"
                                         wire:model.defer="cnic_passport"
                                         class="py-2 px-3 shadow-none outline-none align-middle "
                                         style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number" />
                            </div>
                        @elseif ($showInput == 3)
                            <!-- Non-Foreigner CRC- Child Registration -->
                            <div class="mt-5">
                                <label class="text-sm ">CRC- Child Registration <span
                                            class="text-red-600">*</span></label>
                                <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter CRC without dashes"
                                         wire:model.defer="cnic_passport"
                                         class="py-2 px-3 shadow-none outline-none align-middle "
                                         style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number" />
                            </div>
                        @endif

                        @if ($showInput == 4)
                            <!-- Foreigner Passport -->
                            <div class="mt-5">
                                <label class="text-sm ">Enter Passport <span
                                            class="text-red-600">*</span></label>
                                <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter here" wire:model.defer="cnic_passport"
                                         class="py-2 px-3 shadow-none outline-none align-middle"
                                         style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />
                            </div>
                        @elseif ($showInput == 5)
                            <!-- Foreigner POC -->
                            <div class="mt-5">
                                <label class="text-sm ">Enter POC <span
                                            class="text-red-600">*</span></label>
                                <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter here" wire:model.defer="cnic_passport"
                                         class="py-2 px-3 shadow-none outline-none align-middle "
                                         style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />
                            </div>
                        @elseif ($showInput == 6)
                            <!-- Foreigner NICOP -->
                            <div class="mt-5">
                                <label class="text-sm ">Enter NICOP <span
                                            class="text-red-600">*</span></label>
                                <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter here" wire:model.defer="cnic_passport"
                                         class="py-2 px-3 shadow-none outline-none align-middle"
                                         style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />
                            </div>
                        @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                        <span>
                            <label class="text-sm">Password <span
                                        class="text-red-600">*</span></label>
                            <x-inputs.password id="password" placeholder=" Enter password"
                                               style="box-shadow: none" type="password" name="password" required
                                               wire:model.defer="password" autocomplete="new-password"/>
                        </span>
                        <span>
                            <label class="text-sm">Confirm Password <span
                                        class="text-red-600">*</span></label>
                            <x-inputs.password id="password_confirmation" placeholder=" Confirm password"
                                               style="box-shadow: none" type="password"
                                               name="password_confirmation" required autocomplete="new-password"
                                               wire:model.defer="password_confirmation"/>
                        </span>
                    </div>
                    <div class="mt-5">

                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button style="border-radius: 3px;
                            background: #3c1fff"
                                      class="block w-full px-[27px] py-2 mt-4 text-[16px] items-center justify-center
                            font-normal text-center font-['Segeo-UI'],sans-serif text-white
                            bg-cyan border rounded-[5px] leading-normal ">
                            {{ __('Sign Up') }} </x-jet-button>
                    </div>
                    <div class="flex items-center justify-center mt-4">
                        <p class="mt-1">
                                <span class="text-[#8D98AA] text-[13px] font-normal font-sans">Already have an
                                    account?</span>
                            <a class="text-blue-600 text-[15px] font-semibold hover:underline font-sans"
                               href="{{ route('login') }}">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
