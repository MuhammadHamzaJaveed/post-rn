<x-guest-layout>
    <x-slot name="logo">
    </x-slot>
    <script>
        $(document).ready(function () {
            // $("#exampleModal").modal('show');
        });
    </script>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('images/public_notice_watim_medical_college.jpg') }}"/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex justify-center pr-5 bg-cover bg-center  md:gap-14 lg:gap-1 items-center min-h-screen"
             style="background-image: url('{{asset('images/new-bg-blue.png')}}');">
            <!-- Centered Image and Text -->
            <div class="grid  md:grid-cols-2">
                <div class="flex flex-col justify-center items-center px-4 md:px-8 mb-10 md:mb-1">
                    <div class="flex flex-row justify-center gap-10 md:gap-20 lg:gap-44">
                        <img src="{{ asset('images/privateclogo.png') }}" alt="Login Image"
                             class="rounded-lg w-20 h-20 md:w-20 md:h-20">
                        <img src="{{ asset('images/login.png') }}" alt="Login Image" class="w-20 h-20 md:w-20 md:h-20">
                    </div>
                    <p
                            class="text-white text-center font-poppins text-base lg:text-lg font-semibold tracking-normal pt-4">
                        Online Admission Application Portal for Lady Health Visitor (LHV)<br/>
                        in Public Sector Nursing Colleges of Punjab<br/>

                    </p>
                    <p class="text-white font-poppins tracking-wide">Session {{config('envdata.pdf_session')}}</p>
                    <p
                            class="text-white text-center font-poppins text-base lg:text-lg font-semibold tracking-normal pt-4">
                        University of Health Sciences (UHS), Lahore<br/>
                        Specialized Healthcare & Medical Education Department (SH&MED)<br/>
                        Government of the Punjab

                    </p>
                    {{--
                    <div class="flex flex-col gap-4 mt-6 lg:flex-row">
                        <a href="https://uhs.edu.pk/downloads/bdsadmissions2425.pdf" target="_blank">
                            <x-button label="Private Dental Colleges in Punjab"
                                      style="color: white; background-color: blueviolet" right-icon="cloud-download"/>
                        </a>

                    </div>
                    --}}
                    <div class="mt-5">
                        <a href="#">
                            <x-button label="For Complaint: +92-42-111-33-33-66"
                                      style="color: white; background-color: red" right-icon="phone"/>
                        </a>

                    </div>

                </div>

                <!-- Signup -->
                <div class="w-full flex justify-center items-center md:justify-end md:items-end lg:pr-10 ">
                    <div class="flex flex-col justify-end items-end ">

                        <div class="flex p-5 bg-white rounded-lg shadow-xl md:p-9">

                            <div class="w-full  mt-5">
                                <x-jet-validation-errors class="mb-4"/>

                                @if (session('status'))
                                    <div class="mb-4  font-medium text-sm text-blue-600">
                                        {!! session('status') !!}
                                    </div>
                                @endif
                                @if (session('primary'))
                                    <div class="mb-4 w-80 font-medium text-sm text-blue-600">
                                        {!! session()->pull('primary') !!}
                                    </div>
                                @endif

                                @if (session('message'))
                                    <div class="mb-4 font-medium text-sm text-red-600">
                                        {!! session('message') !!}

                                    </div>
                                @endif

                                <div class="text-center">
                                    <h1 class="mb-4  text-2xl lg:text-3xl font-bold font-inter text-black">
                                        Login here
                                    </h1>
                                </div>

                                <div class=" mt-8">
                                    <x-input id="email" label="Email *" placeholder="Email"
                                             class="w-full md:w-80 lg:w-96" type="email" name="email"
                                             :value="old('email')"
                                             required autofocus/>
                                </div>

                                <div class="mt-4">
                                    <x-input id="password" placeholder="Password" label="Password *"
                                             class="w-full md:w-80 lg:w-96" type="password" name="password" required
                                             autocomplete="current-password"/>
                                </div>

                                <div class="grid grid-cols-2 mt-6">
                                    <div class="flex items-center">
                                        <label for="remember_me" class="flex items-center">
                                            <x-jet-checkbox id="remember_me" name="remember"
                                                            class="w-3 h-3 border-[1.2px] rounded-none border-[#606060]"/>
                                            <span
                                                    class="ml-3 text-[#909090] text-sm font-sans">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    <div class="flex justify-end">
                                        <p class="mt-1">
                                            <a class="text-[#909090] text-[13px] font-normal hover:underline font-sans"
                                               href="{{ route('password.request') }}">
                                                Forgot password?
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <!-- Google Recaptcha -->
                                <div>
                                    <input type="hidden" name="g-recaptcha-response" value="true">
                                    {{--<div class="g-recaptcha mt-4"
                                         data-sitekey={{config('services.recaptcha.key')}}></div>
                                    <script async src="https://www.google.com/recaptcha/api.js"></script>--}}
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-jet-button style="border-radius: 3px ;background: #3c1fff"
                                                  class="block w-full md:w-full px-[27px] py-2 mt-4 text-[16px] items-center justify-center
                                font-normal text-center font-sans text-white bg-cyan border rounded-[5px] leading-normal">
                                        {{ __('Sign In') }}
                                    </x-jet-button>
                                </div>
                                <div class="flex items-center justify-center mt-4">
                                    <p class="mt-1">
                                        <span class="text-[#8D98AA] text-[13px] font-normal font-sans">Don’t have an
                                            account?</span>
                                        <a class="text-blue-600 text-[15px] font-semibold hover:underline font-sans"
                                           href="{{ route('register-new-user') }}">Signup</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>

