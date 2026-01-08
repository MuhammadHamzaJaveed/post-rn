<div class="flex justify-center  flex-col items-center">
    <div class="container centered-container">
        <div class="mt-4 bg-opacity-50 rounded-lg hidden md:block">
            <div class="bg-cover  sm:h-60 grid grid-cols-7 text-center rounded-lg relative items-center"
                style="background-color: #698cff">

                <h2
                    class="pb-40 col-span-8 text-3xl font-bold text-white mb-2 mt-2 font-['Source Sans 3'] tracking-wide">
                    Admission Portal</h2>

                <!-- Steps -->
                <hr
                    class="w-11/12 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border-t-4 border-white">

                <div class="col-start-2 col-span-1 justify-center items-center h-16 sm:h-20 w-12 sm:w-20 absolute text-center"
                    style="left: calc(0% - 40px);">
                    <div class="flex flex-col justify-center items-center">
                    @if ($step1Active)
                        <img src="{{ asset('images/programs.svg') }}">
                    @elseif($step1Completed)
                        <img src="{{ asset('images/tick.svg') }}">
                    @else
                        <img src="{{ asset('images/unselected_programs.svg') }}">
                    @endif

                    <p class="text-sm text-white mt-1 ">Step 1</p>
                    <p class="text-base text-white font-semibold">Program Details</p>
                </div>
                </div>

                <div class="col-start-3 col-span-1 justify-center items-center h-16 sm:h-20 w-12 sm:w-20 absolute text-center"
                    style="left: calc(0% - 40px);">
                    <div class="flex flex-col justify-center items-center">
                    @if ($step2Active)
                        <img src="{{ asset('images/personal.svg') }}">
                    @elseif($step2Completed)
                        <img src="{{ asset('images/tick.svg') }}">
                    @else
                        <img src="{{ asset('images/unselected_personal.svg') }}">
                    @endif

                    <p class="text-sm text-white mt-1 ">Step 2</p>
                    <p class="text-base text-white font-semibold">Personal Details</p>
                    </div>
                </div>

                <div class="col-start-4 col-span-1 justify-center items-center h-16 sm:h-20 w-12 sm:w-20 absolute text-center"
                    style="left: -30px">
                    <div class="flex flex-col justify-center items-center">
                    @if ($step3Active)
                        <img src="{{ asset('images/qualifications.svg') }}">
                    @elseif($step3Completed)
                        <img src="{{ asset('images/tick.svg') }}">
                    @else
                        <img src="{{ asset('images/unselected_qualification.svg') }}">
                    @endif

                    <p class="text-sm text-white mt-1 ">Step 3</p>
                    <p class="text-base text-white  font-semibold">Qualification Details</p>
                    </div>
                </div>

                {{-- <div class="col-start-5 col-span-1 justify-center items-center h-16 sm:h-20 w-12 sm:w-20 absolute text-center"
                    style="left: calc(2% - 40px);">
                    <div class="flex flex-col justify-center items-center">
                    @if ($step4Active)
                        <img src="{{ asset('images/admission.svg') }}">
                    @elseif($step4Completed)
                        <img src="{{ asset('images/tick.svg') }}">
                    @else
                        <img src="{{ asset('images/unselected_admission.svg') }}">
                    @endif

                    <p class="text-sm text-white mt-1">Step 4</p>
                    <p class="text-base text-white  font-semibold">Admission Test</p>
                    </div>
                </div> --}}

                <div class="col-start-5 col-span-1 justify-center items-center h-16 sm:h-20 w-12 sm:w-20 absolute text-center"
                    style="left: calc(2% - 40px);">
                    <div class="flex flex-col justify-center items-center">
                    @if ($step5Active)
                        <img src="{{ asset('images/preferences.svg') }}">
                    @elseif($step5Completed)
                        <img src="{{ asset('images/tick.svg') }}">
                    @else
                        <img src="{{ asset('images/unselected_preferences.svg') }}">
                    @endif

                    <p class="text-sm  text-white mt-1">Step 4</p>
                    <p class="text-base font-semibold text-white  text-center">College Preferences</p>
                    </div>
                </div>

                <div class="col-start-6 col-span-1 justify-center items-center h-16 sm:h-20 w-12 sm:w-20 absolute text-center"
                    style="left: calc(2% - 40px);">
                    <div class="flex flex-col justify-center items-center">
                    @if ($step6Active)
                        <img src="{{ asset('images/affidavit.svg') }}">
                    @elseif($step6Completed)
                        <img src="{{ asset('images/tick.svg') }}">
                    @else
                        <img src="{{ asset('images/unselected_affidavit.svg') }}">
                    @endif

                    <p class="text-sm text-white mt-1">Step 5</p>
                    <p class="text-base font-semibold text-white " >Documents Upload</p>
                    </div>
                </div>

                <div class="col-start-7 col-span-1 justify-center items-center h-16 sm:h-20 w-12 sm:w-20 absolute text-center"
                    style="left: calc(2% - 40px);">
                    <div class="flex flex-col justify-center items-center">
                    @if ($step7Active)
                        <img src="{{ asset('images/affidavit.svg') }}">
                    @elseif($step7Completed)
                        <img src="{{ asset('images/tick.svg') }}">
                    @else
                        <img src="{{ asset('images/unselected_affidavit.svg') }}">
                    @endif

                    <p class="text-sm text-white mt-1">Step 6</p>
                    <p class="text-base font-semibold text-white " >Undertaking</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container centered-container">
       {{-- @if ($step === 1)
            <livewire:uhs-forms.steps.programs />
        @endif
        @if ($step === 2)
            <livewire:uhs-forms.steps.personal-details />
        @endif
        @if ($step === 3)
            <livewire:uhs-forms.steps.qualifications />
        @endif
        @if($step === 4)
            <livewire:uhs-forms.steps.colleges-list />
        @endif
        @if ($step === 5)
            <livewire:uhs-forms.steps.docs-affidavit />
        @endif
        @if ($step === 6)
            <livewire:uhs-forms.steps.affidavit />
        @endif

        --}}


            @if ($step === 1)
                <livewire:uhs-forms.steps.programs />
            @endif
            @if ($step === 2)
                <livewire:uhs-forms.steps.personal-details />
            @endif
            @if ($step === 3)
                <livewire:uhs-forms.steps.qualifications />
            @endif
            {{--
            @if ($step === 4)
                    <livewire:uhs-forms.steps.admission-test />
                @endif
            --}}
            @if($step === 5)
                <livewire:uhs-forms.steps.colleges-list />
            @endif
            @if ($step === 6)
                <livewire:uhs-forms.steps.docs-affidavit />
            @endif
            @if ($step === 7)
                <livewire:uhs-forms.steps.affidavit />
            @endif


</div>
</div>
