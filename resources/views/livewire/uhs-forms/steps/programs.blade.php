<form wire:submit.prevent="submit">
    <div class="mt-7 mb-7 bg-white rounded-lg "
         style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
        <div>
            <p class=" p-5 md:px-10 md:py-4 text-2xl font-medium text-red-600 tracking-[0.29px] font-sans">IMPORTANT
                INSTRUCTION:</p>
            <hr class="border-t-2 w-full border-[#DAE4EA]">
        </div>
        <div class="p-5 pb-10 md:px-10 md:pt-5 md:pb-10 gap-4 ">
            <div class="md:mr-4">
                <ol>
                    <li class="pt-3 text-lg font-normal flex flex-row">
                        <span class="text-green-900  pr-3">
                            <x-heroicon-s-light-bulb class="h-6 w-6 text-green-800" />
                        </span>
                        <p>Before completing this admission form, please review the Admission Policy for Public Sector Nursing Colleges in Punjab for the 2025-26 session. This policy was issued by the Specialized Healthcare and Medical Education Department, Government of Punjab and can be accessed at (link to policy).
                        </p>
                    </li>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-green-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-green-800" />
                        </span>This application portal is for BS Nursing (Generic) program in Public Sector Nursing Colleges. Candidates may apply for Morning or Evening separately or for boht sessions through one designated portal for each program.
                    </li>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-green-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-green-800" />
                        </span> Only applications submitted through the official portals of the University of Health Sciences Lahore will be accepted. No college or other institution is authorized to process  Nursing applications through any other means.
                    </li>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-green-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-green-800" />
                        </span> The application form can be edited until the submission deadline. After this date, the form will be locked, and no further edits will be allowed.
                    </li> 
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-green-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-green-800" />
                        </span>It is the candidate’s responsibility to complete this form accurately and thoroughly. The University will not be responsible for the rejection of applications that are incomplete or incorrectly filled by the candidate.
                    </li> 
                    {{-- <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-green-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-green-800" />
                        </span>Candidates must fill out the Application Form carefully and completely. They may edit their application until the submission deadline. After the deadline, the application will be locked, and no further changes will be possible.</li> 
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-green-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-green-800" />
                        </span> If a candidate edits his/her application after the initial submission but before the deadline, only the most recent submission will be considered.</li> --}}
                    <!-- <li class="pt-3 text-lg font-normal flex flex-row"><span
                                class="text-green-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-green-800" />
                        </span><p class="text-red-500 font-bold"> The candidate shall not be able to add program choices once application
                            processing fee is submitted as per system-generated challan.</p>
                    </li> -->


                </ol>
                {{-- <div class="flex flex-col justify-center items-center gap-5">

                    <a href="https://www.uhs.edu.pk/mcat2022/Prospectus123.pdf" target="_blank">
                    <x-button green lg class="mt-10 mr-3 " style="background-color: #179F9E">
                        <span class="text-white text-lg font-semibold">Prospectus</span>
                    </x-button>
                </a>
                </div> --}}
                <div class="mt-7 flex items-center gap-4">
                    <input type="checkbox" wire:model.defer="agreed" id="agree-label" required class="w-5 h-5 rounded border-3 text-2xl font-bold text-blue-600 bg-gray-100 border-gray-900 focus:blue-green-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-100 dark:border-gray-300">
                        <span class="text-black font-semibold text-lg">I have read the instructions carefully.</span>
                </input>
                </div>
                @error('agreed')
                    <div class="error text-red-600 mt-2 ">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>


    <div class="mt-7 mb-7 lg:h-auto bg-white rounded-lg "
         style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
        <div>
            <p class=" p-5 md:px-10 md:py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">
                Choose the Diploma</p>
            <hr class="border-t-2 w-full border-[#DAE4EA]">
        </div>

        <div class="p-5 pb-10 md:px-10 md:pt-5 md:pb-14 grid grid-cols-1  gap-10 " >
            <div class="md:mr-4">
                <!-- <div class="text-2xl text-[#333333] font-semibold tracking-[0.29px] font-sans mb-5">
                    Choose the District:
                </div> -->

{{--                  <div class="mt-5">--}}
{{--                    <label class="text-black text-lg font-medium font-sans ">Select District <span--}}
{{--                                class="text-red-600">*</span></label>--}}
{{--                    <x-select style="padding: 8px 12px; box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"--}}
{{--                              placeholder="Please select Discipline" wire:model.defer="disciplineId"--}}
{{--                              rightIcon="chevron-down"--}}
{{--                              option-value="id" option-label="name" :options="$this->allDisciplines"--}}
{{--                              @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }"/>--}}
{{--                </div>--}}

                 <div class="flex flex-col md:flex-col lg:flex-row gap-3" >
                    @foreach ($this->allSeats as $seatCategories)
                        <span
                                class="{{ $seatCategories->id == $seatCategory ? 'mb-2 md:mb-0 transition-colors duration-0 md:mr-2 border border-[#5345ff] rounded-md flex items-center py-2 px-5 bg-[#5345ff]' : 'mb-2 md:mb-0 md:mr-2 border transition-colors duration-0 border-[#5345ff] rounded-md py-2 px-5 flex items-center  bg-[#ffffff]' }}">
                            <div wire:ignore>
                                <x-radio id="{{ $seatCategories->id + 30 }}" wire:model="seatCategory"
                                         value="{{ $seatCategories->id }}"  checked />
                            </div>
                            <span
                                    class="{{ $seatCategories->id == $seatCategory ? 'ml-2 text-white text-base font-medium' : 'ml-2 text-[#5345ff] text-base font-medium' }}">
                                {{ $seatCategories->name }} </span>
                        </span>
                    @endforeach
                </div>

                @error('program')
                <div class="error text-red-600 mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        {{--<div class="p-5 pb-10 md:px-10 md:pt-5 md:pb-14 grid grid-cols-1 gap-10 ">
            <div class="md:mr-4">
                <div class="text-2xl text-[#333333] font-semibold tracking-[0.29px] font-sans mb-5">
                    You Applied on Following Seat
                </div>

                <div class="flex flex-col md:flex-col lg:flex-row gap-3">
                        <span
                                class="'mb-2 md:mb-0 transition-colors duration-0 md:mr-2 border border-[#5345ff] rounded-md flex items-center py-2 px-5 bg-[#5345ff] '">
                            <div wire:ignore>
                                <x-radio id="{{ $foreigner }}" wire:model="foreigner" disabled
                                         value="{{ $foreigner }}"/>
                            </div>
                            <span
                                    class='ml-2 text-white text-base font-medium'>
                                {{ $foreigner == 1 ? 'Overseas' : 'Open Merit' }} </span>
                            </span>
                    </span>
                </div>

                @error('program')
                <div class="error text-red-600 mt-2">{{ $message }}</div>
                @enderror
                @if ($selectedProgramId >= 3)
                    <div class="mt-8 mb-5">
                        <p class="text-2xl text-[#333333] font-semibold tracking-[0.29px] font-sans mb-5">Select
                            Priority of the Program:
                        </p>
                    </div>

                    <div x-data="{ swap: {{ auth()->user()->program_priority === 2 ? 'true' : 'false' }} }"
                         class="mb-8 text-start">
                        <div class="flex flex-col gap-3">
                            <!-- MBBS Text -->
                            <div class="w-56 bg-white px-4 py-2 md:px-4 md:py-2 rounded-lg flex flex-row gap-1 border-2 items-center justify-evenly"
                                 x-on:click="swap = !swap; $wire.togglePriority();">
                                <img src="{{ asset('images/1stpriority.svg') }}" alt="" class="w-28">
                                <span class="text-gray-700 text-base md:text-lg font-medium"
                                      x-text="swap ? 'BDS' : 'MBBS'"></span>
                            </div>

                            <!-- Toggle Priority Button -->
                            <div class="relative">
                                <x-heroicon-s-switch-vertical
                                        class="w-8 h-8 ml-24 items-center text-center text-[#888888]"
                                        x-on:click="swap = !swap; $wire.togglePriority();"/>
                            </div>

                            <!-- BDS Text -->
                            <div class="w-56 bg-white px-2 py-2 md:px-2 md:py-2 border-2 rounded-lg flex flex-row items-center justify-evenly"
                                 x-on:click="swap = !swap; $wire.togglePriority();">
                                <img src="{{ asset('images/2ndpriority.svg') }}" alt="" class="w-28">
                                <span class="text-gray-700 text-base md:text-lg font-medium"
                                      x-text="swap ? 'MBBS' : 'BDS'"></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="text-lg font-normal text-red-400">Click on any of the buttons above to change the
                            priority of the programs.</p>
                    </div>

                    <div class="mt-7 flex items-center gap-4">
                        <input type="checkbox" wire:model.defer="affirmation" id="priority-label" required
                               class="w-5 h-5 rounded border-3 text-2xl font-bold text-green-600 bg-gray-100 border-gray-900 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-100 dark:border-gray-300">
                        <span class="text-black font-semibold text-lg">I agree with the selected priority.</span>
                        </input>
                    </div>
                @endif

            </div>

            @if(boolval($foreigner))
                <div class="mt-7 md:mt-0">
                    <div class="text-3xl text-[#333333] font-semibold tracking-[0.29px] font-sans mb-5">
                        Do you also want to apply on Open Merit?
                    </div>
                    <div class="flex items-center space-x-4">
                        <div
                                class="{{ $isOpenMerit == '1' ? 'mb-2 md:mb-0 transition-colors duration-0 md:mr-2 border border-[#5345ff] rounded-md flex items-center py-2 px-5 bg-[#5345ff]' : 'mb-2 md:mb-0 md:mr-2 border transition-colors duration-0 border-[#5345ff] rounded-md py-2 px-5 flex items-center  bg-[#EBFFFF]' }}">
                            <div wire:ignore>
                                <x-radio id="yes" wire:model="isOpenMerit" value="1"/>
                            </div>
                            <span class="{{ $isOpenMerit == '1' ? 'ml-2 text-white text-base font-medium' : 'ml-2 text-[#5345ff] text-base font-medium' }}">
                    Yes
                </span>
                        </div>

                        <div
                                class="{{ $isOpenMerit == '0' ? 'mb-2 md:mb-0 transition-colors duration-0 md:mr-2 border border-[#5345ff] rounded-md flex items-center py-2 px-5 bg-[#5345ff]' : 'mb-2 md:mb-0 md:mr-2 border transition-colors duration-0 border-[#5345ff] rounded-md py-2 px-5 flex items-center  bg-[#EBFFFF]' }}">
                            <div wire:ignore>
                                <x-radio id="no" wire:model="isOpenMerit" value="0"/>
                            </div>
                            <span class="{{ $isOpenMerit == '0' ? 'ml-2 text-white text-base font-medium' : 'ml-2 text-[#5345ff] text-base font-medium' }}">
                    No
                </span>
                        </div>


                    </div>

                    @error('foreigner')
                    <div class="error text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            @endif
        </div>--}}

    </div>
    <div class="text-right">
        <button
                class=" bg-[#3c1fff] hover:bg-[#5345ff] text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg border border-[#5345ff]  gap-2 "
                type="submit" wire:keydown.enter.prevent="submit">
<span class="flex flex-row items-center gap-2 justify-center text-white font-semibold text-base">
    Save & Submit
    <x-heroicon-s-arrow-narrow-right class="w-5 h-5"/>
    <span wire:loading wire:target="submit">
        <p class="flex"><x-loader/></p>
    </span>
</span>
        </button>
    </div>
</form>
