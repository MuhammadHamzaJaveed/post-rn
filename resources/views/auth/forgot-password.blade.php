<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="flex justify-center bg-cover bg-center  md:gap-14 lg:gap-1 items-center min-h-screen"
            style="background-image: url('{{asset('images/new-bg-blue.png')}}');">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-center pb-5" style="padding-top: 70px">
                <div class="flex flex-col justify-center items-center px-4 md:px-8">
                    <div class="flex flex-row justify-center gap-10 md:gap-20 lg:gap-44">
                        <img src="{{ asset('images/privateclogo.png') }}" alt="Login Image"
                            class="rounded-lg w-20 h-20 md:w-20 md:h-20">
                        <img src="{{ asset('images/login.png') }}" alt="Login Image" class="w-20 h-20 md:w-20 md:h-20">
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
                </div>
                <div class="flex justify-center lg:justify-end items-center mt-7 lg:mt-0 lg:pr-10">
                    <div class="bg-white px-6 py-10 md:px-10 md:py-10 w-full md:w-96 lg:w-[500px] rounded-xl">
                        <x-jet-validation-errors class="mb-4" />

                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="mb-8">
                            <p class="font-poppins font-bold text-2xl text-black text-center">Forgot Password
                            </p>
                        </div>
                        <div>
                            <p class="mb-2 mt-4 text-sm text-gray-600 font-['Segeo-UI'],sans-serif">
                                Forgot your password? No problem. Just let us know your email address and we
                                will email
                                you a password reset link that will allow you to choose a new one.
                            </p>
                        </div>

                        <div class=" mt-8">
                            <x-input id="email" placeholder=" Enter email" type="email" name="email"
                                label="Email address" required autofocus  />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button style="border-radius: 3px;
                       background: #3c1fff;"
                                class="block w-full px-[27px] py-2 mt-4 text-[16px] items-center justify-center
                       font-normal text-center font-['Segeo-UI'],sans-serif text-white
                       bg-cyan border rounded-[5px] leading-normal ">
                                {{ __('Send Password Reset Link') }} </x-jet-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        </div>
    </form>
</x-guest-layout>
