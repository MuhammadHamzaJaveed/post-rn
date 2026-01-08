<x-guest-layout>
    <x-slot name="logo">
    </x-slot>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="flex items-center min-h-screen p-6 bg-cover bg-gray-50" style="background-image: url('{{ asset('images/new-bg-blue.png') }}')">
            <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl">
                <div class="flex flex-col  overflow-y-auto md:flex-row ">
                    <div class="lg:w-[60%] h-32 md:h-auto md:w-1/2">
                        <img aria-hidden="true" class="lg:object-fill w-full h-full sm:object-cover "
                            src="{{ asset('images/login-desk4.jpg') }}" alt="Office" />
                    </div>

                    <div style="margin: 10px ;"
                        class="flex flex-col lg:m-auto lg:ml-2 sm:m-autp items-center justify-center  sm:p-12 md:w-1/2">
                        <x-jet-validation-errors class="mb-4" />

                        <div class="w-[328px]" style="@media (max-width: 767px) { margin-bottom: 40px; }">
                            <h1 class="mb-2 lg:text-[32px] font-bold text-black sm:text-2xl">
                                Reset Password
                            </h1>
                            {{-- Email input field --}}

                            <div class="flex items-center mt-7 ml-2">

                                <x-heroicon-s-user class="w-5 h-5 text-[#606060]" />
                                <x-jet-input id="email" placeholder="  Email"
                                    style="box-shadow: none; border:0 0 1px solid #000; width:100%"
                                    class="block ml-[-20px] pr-8 pl-8 border-b-2 bg-transparent border-0 focus:border-[#00AEC6] focus:outline-white
                                        focus:shadow-outline-[#00AEC6] form-input rounded-sm w-full"
                                    type="email" name="email" required autofocus />
                            </div>

                            {{-- password input field --}}

                            <div class="flex items-center mt-2 ml-2">

                                <x-heroicon-s-lock-closed class="w-5 h-5 text-[#606060]"/>
                                <x-jet-input id="password" placeholder="  Password"
                                    style="box-shadow: none;border:0 0 1px solid #606060; width:100%;"
                                    class="block ml-[-20px] pr-8 pl-8 border-b-2 bg-transparent border-0 focus:border-[#00AEC6] focus:outline-0
                                        focus:shadow-outline-[#00AEC6] form-input rounded-sm w-96"
                                    type="password" name="password" required autocomplete="new-password" />
                            </div>

                            {{-- Confirm password field --}}
                            <div class="flex items-center mt-2 ml-2">

                                <x-heroicon-s-lock-closed class="w-5 h-5 text-[#606060]"/>
                                <x-jet-input id="password_confirmation" placeholder="  Confirm password"
                                    style="box-shadow: none;border:0 0 1px solid #606060; width:100%;"
                                    class="block ml-[-20px] pr-8 pl-8 border-b-2 bg-transparent border-0 focus:border-[#00AEC6] focus:outline-0
                                        focus:shadow-outline-[#00AEC6] form-input rounded-sm w-96"
                                    type="password" name="password_confirmation" required
                                    autocomplete="new-password" />
                            </div>

                            {{-- remember me button --}}
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-jet-checkbox id="remember_me" name="remember"
                                        class=" w-3 h-3 border-[1.2px] rounded-none border-[#606060]" />
                                    <span class="ml-3 text-[#909090] text-sm">{{ __('Remember me') }}</span>
                                </label>
                            </div>


                            <div class="flex items-center justify-end mt-2">
                                <x-jet-button
                                    style="border-radius: 3px;
                                background: rgba(0, 174, 198, 0.80); font-weight: 400"
                                    class="block sm:mb-3 w-[328px] px-[20px] py-1 mt-4 text-[15px] items-center justify-center
                                font-normal text-center font-['Inter'] text-white
                                bg-cyan border rounded-[5px] leading-normal ">
                                    {{ __('Reset & Proceed') }} </x-jet-button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>