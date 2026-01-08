<div>
    <form wire:submit.prevent="submit">
        <div class="mt-7 mb-7 bg-white rounded-lg"
            style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
            <div>
                <p class="p-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">Admission
                    Test
                </p>
                <hr class="border-t-2 w-full border-[#DAE4EA]">
            </div>
            <div class="p-5 md:p-10">
                {{-- radio button section 1st --}}

                <div class="grid grid-cols-2 lg:grid-cols-3 gap-0">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 col-span-3 md:col-span-3">
                        <div class="text-2xl font-semibold text-[#333333] font-['Source Sans 3']">Select Test Type:</div>

                        <div
                            class="{{ $selectedExam == 1 ? ' transition-colors duration-0 flex items-center gap-2 border rounded-lg p-2  border-[#e6e7ff] bg-[#3c1fff]' : 'bg-[#e6e7ff] transition-colors duration-0 flex items-center gap-2 border rounded-lg p-2 border-[#e6e7ff]' }}">
                            <x-radio id="mdcat1" class="ml-2" wire:model="selectedExam" value="1" />

                            <span
                                class="{{ $selectedExam == 1 ? 'text-lg font-semibold text-white' : 'text-lg font-semibold' }}">
                                MDCAT
                            </span>
                        </div>
                        @if (auth()->user()->foreigner == 1)
                            <div
                                class="{{ $selectedExam == 2 ? ' transition-colors duration-0 flex items-center gap-2 border rounded-lg p-2 border-[#e6e7ff] bg-[#3c1fff]' : 'bg-[#e6e7ff] transition-colors duration-0 flex items-center gap-2 border rounded-lg p-2 border-[#e6e7ff]' }}">

                                <x-radio id="sat1" class="ml-2" wire:model="selectedExam" value="2" />

                                <span
                                    class="{{ $selectedExam == 2 ? 'text-lg font-semibold text-white' : 'text-lg font-semibold' }}">
                                    SAT(II)
                                </span>
                            </div>

                            <div
                                class="{{ $selectedExam == 3 ? ' transition-colors duration-0 flex items-center gap-2 border rounded-lg p-2 border-[#e6e7ff] bg-[#3c1fff]' : 'bg-[#e6e7ff] transition-colors duration-0 flex items-center gap-2 border rounded-lg p-2 border-[#e6e7ff]' }}">

                                <x-radio id="ucat1" class="ml-2" wire:model="selectedExam" value="3" />

                                <span
                                    class="{{ $selectedExam == 3 ? 'text-lg font-semibold text-white' : 'text-lg font-semibold' }}">
                                    UCAT
                                </span>
                            </div>
                            <div
                                class="{{ $selectedExam == 4 ? ' transition-colors duration-0 flex items-center gap-2 border rounded-lg p-2 border-[#e6e7ff] bg-[#3c1fff]' : 'bg-[#e6e7ff] transition-colors duration-0 flex items-center gap-2 border rounded-lg p-2 border-[#e6e7ff]'}}">

                                <x-radio id="mcat1" class="ml-2" wire:model="selectedExam" value="4" />

                                <span
                                    class="{{ $selectedExam == 4 ? 'text-lg font-semibold text-white' : 'text-lg font-semibold' }}">
                                    International MCAT
                                </span>
                            </div>
                        @endif

                    </div>
                </div>
                {{-- data first --}}
                <div>

                    @if ($selectedExam == 1)
                        <div>
                            <div class="mt-9">
                                <p class="text-lg font-medium text-gray-700 font-italic text-start"><span
                                        class="text-red-500 pr-3">Read Carefully: </span>
                                    The following results are registered under your CNIC number. If you do not see any
                                    results in the fields below, you can enter them yourself.
                                </p>
                            </div>
                            <div class="text-xl font-semibold text-[#333333] mt-12 mb-4">MDCAT Marks</div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div id="mdcc">
                                    <label class="text-black text-lg font-medium font-sans ">MDCAT Roll No. <span
                                            class="text-red-600">*</span></label>
                                    <x-input type="number" placeholder="MDCAT Roll-No." wire:model.defer="mdCatCnic"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                         />
                                {{-- This condition is to lock MDCAT marks if we have the record for the current user in results table --}}
                                {{--:disabled="auth()->user()->qualifications->second_Db ? true : false"--}}
                                </div>

                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Center Appeared in <span
                                            class="text-red-600">*</span></label>
                                    <x-select
                                        style="padding: 8px 12px;box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        placeholder="Select the Center you appeared in" wire:model.defer="mdCatCenter"
                                        rightIcon="chevron-down" option-value="id" option-label="name"
                                        :options="$this->allMdCatCenter" />

                                </div>

                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Passing Year<span
                                                class="text-red-600">*</span></label>
                                    <x-select
                                            style="padding: 8px 12px;box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                            placeholder="Select the passing year" wire:model.defer="mdCatPassingYear"
                                            rightIcon="chevron-down" option-value="id" option-label="name"
                                            :options="$this->AllMdcatPassingYear"
                                    />

                                </div>

                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Marks Obtained (out of 200)
                                        <span class="text-red-600">*</span></label>
                                    <x-input placeholder="Marks Obtained out of 200."
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        wire:model.defer="mdCatObtainedMarks"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number"
                                        @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                                    {{-- This condition is to lock MDCAT marks if we have the record for the current user in results table --}}
                                    {{-- :disabled="auth()->user()->qualifications->second_Db ? true : false"--}}

                                </div>

                            </div>

                            <div class="text-xl font-semibold text-[#333333] mt-6 mb-4">MDCAT Applicant</div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Applicant CNIC/ Passport
                                        No. <span class="text-red-600">*</span></label>
                                    <x-input placeholder="Applicant CNIC"
                                        class="py-2 px-3 cursor-not-allowed text-gray-500 shadow-none outline-none align-middle"
                                        wire:model.defer="cnic" readonly
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($selectedExam == 2)
                        <div>
                            <div class="mt-9">
                                <p class="text-lg font-medium text-gray-700 font-italic text-start"><span
                                        class="text-red-500 pr-3">Read Carefully: </span>
                                    SAT-II conducted by the College Board (only for candidates seeking admission
                                    on a special program seat predefined exclusively for foreign students.)
                                </p>
                            </div>
                            <div class="text-xl font-semibold text-[#333333] mt-12 mb-4">SAT(II) Marks</div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Test Date(s) <span
                                            class="text-red-600">*</span></label>
                                    <x-datetime-picker placeholder="" wire:model.defer="satTestDate"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" without-time />

                                </div>

                                <div class="flex flex-col">
                                    <div>
                                        <label class="text-black text-lg font-medium font-sans "> Biology Obtained
                                            Marks
                                            (out of 800)<span class="text-red-600">*</span></label>
                                        <x-input placeholder="Marks Obtained of Biology (OB)  out of 800"
                                            class="py-2 px-3 shadow-none outline-none align-middle"
                                            name="BiologyMarksObtained" wire:model.defer="satBiologyMarks"
                                            style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                            type="number"
                                            @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                    </div>

                                    @error('satBiologyMarks')
                                        <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">

                                <div class="flex flex-col">
                                    <div>
                                        <label class="text-black text-lg font-medium font-sans ">Chemistry Obtained
                                            Marks
                                            (out of 800) <span class="text-red-600">*</span></label>
                                        <x-input placeholder="Marks Obtained of Chemistry (OC)  Marks out of 800"
                                            class="py-2 px-3 shadow-none outline-none align-middle"
                                            name="ChemistryMarksObtained" wire:model.defer="satChemistryMarks"
                                            style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                            type="number"
                                            @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                    </div>

                                    @error('satChemistryMarks')
                                        <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex-col flex">
                                    <div>
                                        <label class="text-black text-lg font-medium font-sans ">Physics / Mathematics
                                            Obtained Marks (out of 800) <span class="text-red-600">*</span></label>
                                        <x-input
                                            placeholder="Marks Obtained of Physics / Mathematics (OF)  Marks out of 800"
                                            class="py-2 px-3 shadow-none outline-none align-middle"
                                            wire:model.defer="satPhyMathMarks" name="PhyMathMarksObtained"
                                            style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                            type="number"
                                            @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                    </div>

                                    @error('satPhyMathMarks')
                                        <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xl font-semibold text-[#333333] mt-6 mb-4">SAT(II) Applicant</div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Username for Candidate’s
                                        College Board ID <span class="text-red-600">*</span></label>
                                    <x-input placeholder="Enter Applicant SAT(II) Username"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        wire:model.defer="satUsername"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                </div>

                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Password for Candidate’s
                                        College Board ID <span class="text-red-700 text-sm mt-1">*</span></label>
                                    <x-input placeholder="Enter Applicant SAT(II) Password"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        wire:model.defer="satPassword"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                </div>

                            </div>
                        </div>
                    @endif

                    @if ($selectedExam == 3)
                        <div>
                            <div class="mt-9">
                                <p class="text-lg font-medium text-gray-700 font-italic text-start"><span
                                        class="text-red-500 pr-3">Read Carefully: </span>
                                    UCAT- University Clinical Aptitude Test conducted by Pearson UVE- UKCAT Consortium
                                    (only
                                    for candidates seeking admission on a special program seat predefined exclusively
                                    for
                                    foreign students.)
                                </p>
                            </div>
                            <div class="text-xl font-semibold text-[#333333] mt-12 mb-4">UCAT Marks</div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Test Date <span
                                            class="text-red-600">*</span></label>
                                    <x-datetime-picker placeholder="Select Test Date" wire:model.defer="ucatTestDate"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        without-time />

                                </div>

                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Score Obtained (out of
                                        3600)
                                        <span class="text-red-600">*</span></label>
                                    <x-input placeholder="Enter the Score Obtained (out of 3600)"
                                        wire:model.defer="ucatObtainedMarks"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        type="number"
                                        @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                </div>


                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Band Score <span
                                            class="text-red-600">*</span></label>
                                   {{-- <x-select wire:model.defer="ucatBand"
                                        placeholder="Choose Band Score obtained out of 4" :options="['1', '2', '3', '4']"
                                        style="padding: 8px 8px;" rightIcon="chevron-down"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />--}}
                                    <x-input placeholder="Choose Band Score obtained out of 4"
                                             wire:model.defer="ucatBand"
                                             class="py-2 px-3 shadow-none outline-none align-middle"
                                             style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                             type="number"
                                             @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                </div>

                            </div>

                            <div class="text-xl font-semibold text-[#333333] mt-6 mb-4">UCAT Applicant</div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">UCAT Candidate ID/ UCAS
                                        PID
                                        <span class="text-red-600">*</span></label>
                                    <x-input placeholder=" Kindly enter in the format UKCAT + 6 digits"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        wire:model.defer="ucatCandidateId"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                </div>

                            </div>
                        </div>
                    @endif

                    @if ($selectedExam == 4)
                        <div>
                            <div class="mt-9">
                                <p class="text-lg font-medium text-gray-700 font-italic text-start"><span
                                        class="text-red-500 pr-3">Read Carefully: </span>
                                    International MCAT conducted by AAMC- Association of American Medical
                                    Colleges (only for candidates seeking admission on a special program seat
                                    predefined exclusively for foreign students.)
                                </p>
                            </div>
                            <div class="text-xl font-semibold text-[#333333] mt-12 mb-4">International MCAT Marks</div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Test Date<span
                                            class="text-red-600">*</span></label>
                                    <x-datetime-picker placeholder="Select Test Date" wire:model.defer="mcatTestDate"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        wire:model.defer="mcatTestDate"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        without-time />

                                </div>

                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">International MCAT Score
                                        Obtained (out of 528) <span class="text-red-600">*</span></label>
                                    <x-input placeholder="Enter the Score Obtained (out of 528)"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        wire:model.defer="mcatObtainedMarks"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        type="number"
                                        @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                </div>

                            </div>

                            <div class="text-xl font-semibold text-[#333333] mt-6 mb-4">International MCAT Applicant
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Username for Candidate’s
                                        AAMC
                                        ID <span class="text-red-600">*</span></label>
                                    <x-input placeholder="Enter Username for Candidate’s AAMC ID"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        wire:model.defer="mcatUsername"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                </div>

                                <div>
                                    <label class="text-black text-lg font-medium font-sans ">Password for Candidate’s
                                        AAMC
                                        ID <span class="text-red-600">*</span></label>
                                    <x-input placeholder="Enter Password for Candidate’s AAMC ID"
                                        class="py-2 px-3 shadow-none outline-none align-middle"
                                        wire:model.defer="mcatPassword"
                                        style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                        @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                                </div>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>



        {{-- Button --}}
        <div class="grid grid-cols-2 mb-16 ">
            <div>
                <button wire:click.prevent="$emit('goToStep', 3)" wire:keydown.enter.prevent="$emit('goToStep', 3)"
                    class=" bg-transparent hover:bg-white text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg border-2 border-[#9BABB7]  gap-2 ">
                    <span
                        class="flex flex-row items-center gap-2 justify-center text-[#687076] font-semibold text-base">
                        <x-heroicon-s-arrow-narrow-left class="w-5 h-5" />
                        Previous Step
                    </span>
                </button>
            </div>
            <div class="text-right">

                <button
                    class=" bg-[#3c1fff] hover:bg-[#5345ff] text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg  gap-2 "
                    type="submit" wire:keydown.enter.prevent="submit">
                    <span class="flex flex-row items-center gap-2 justify-center text-white font-semibold text-base">
                        Save & Submit
                        <x-heroicon-s-arrow-narrow-right class="w-5 h-5" />
                        <span wire:loading wire:target="submit">
                            <p class="flex"><x-loader /></p>
                        </span>
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>
