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
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span>  The applicant is required to select all available colleges from the drop-down menu provided.
                    </li>
                  
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span> The sequence in which colleges are selected shall constitute the applicant’s Order of Preference and shall be strictly followed for the purpose of admission. Applicants are advised to exercise due care while setting their preferences.</li>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span> College preferences may be modified only up to the prescribed submission deadline. No change or amendment shall be permitted after the expiry of the deadline.</li>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span>  For modification of preferences, the applicant shall use the “Reset” option. In the event of a change in seat category, the previously selected college preference list shall stand cancelled, and the applicant shall be required to re-enter the preferences afresh.</li>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span> Admissions to the Post RN BS Nursing programme are offered total 11 Nursing Colleges.
                    </li>
                    <li class="pt-3 text-lg font-normal flex flex-row"><span
                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />
                        </span> Where an applicant edits and resubmits the application after initial submission but before the deadline, only the latest submission shall be treated as final and considered for admission.
                    </li>
                  
{{--                    <li class="pt-3 text-lg font-normal flex flex-row"><span--}}
{{--                            class="text-blue-900  pr-3"><x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800" />--}}
{{--                        </span> If a candidate edits his/her application after the initial submission but before the deadline, only the most recent submission will be considered.--}}
{{--                    </li>--}}
                  
                   
                        </ol>
                <div class="mt-7 flex items-center gap-4">
                    <input type="checkbox" wire:model.defer="agreed" required id="agree-label" class="w-5 h-5 rounded border-3 text-2xl font-bold text-blue-600 bg-gray-100 border-gray-900 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-100 dark:border-gray-300">
                        <span class="text-black font-semibold text-lg">I hereby confirm that I have read and understood the above instructions and undertake to comply with them.</span>
                </input>
                </div>
                @error('agreed')
                    <div class="error text-red-600 mt-2 ">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

        <div class="mb-7 mt-7 bg-white border border-brown-500 rounded-lg"
            style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0,0,0,0.03);">
            <div class="p-10">
                {{-- top header --}}
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <p
                                class="text-center md:text-start text-2xl font-medium text-[#333333] tracking-[0.29px] font-roboto">
                             Colleges List
                        </p>

                    </div>

                </div>
                {{-- multiselect --}}
                <div class="mt-5 grid grid-cols-1 md:grid-cols-8 items-center gap-2 md:gap-5">
                    <div class="mb-7 mt-2 md:col-span-6 lg:col-span-7 ">
                        <span>
                            <label class="font-semibold">Select a College <span class="text-sm text-black float-right">{{count($this->selectedMorningList)}}/{{count($this->nursingMorningColleges)}}</span></label>
                            <x-select class=" mt-1 text-black" style="padding: 8px 12px;box-shadow: none; border: 2px solid gray;"
                                      label="" placeholder="Please select colleges from this drop down"
                                      option-id="id" option-value="name" option-label="name" :options="$this->nursingMorningColleges"
                                      wire:model="selectedMorningList" rightIcon="plus" multiselect />
                        </span>
                    </div>
                    {{-- Reset Button --}}
                    <div
                        class="mt-1 flex   
                md:col-span-2 lg:col-span-1 gap-3 justify-center md:justify-end float-right">
                        <button
                            class="py-2 px-5 bg-red-600 text-base text-white font-medium rounded-lg flex items-center gap-3"
                            type="button" wire:click="resetMorningScreen">
                            Reset <span><x-heroicon-s-trash class="h-4 w-4 text-white" /> </span>
                        </button>

                    </div>
                </div>
                {{-- table --}}
                <div class="mt-5 ">
                    <div class="relative overflow-x-auto shadow sm:rounded-lg">
                        <table id="table_mbbs_id"
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
                            <thead
                                class="text-sm text-gray-900 uppercase bg-[#d2dbe2] dark:bg-[#dcdfec] dark:text-gray-500">
                                <tr>
                                    <th scope="col" class="px-5 py-2 w-1/5">Preference. No.</th>
                                    <th scope="col" class="px-6 py-5 w-3/5">
                                        Name of College
                                    </th>
                                    <th scope="col" class="px-6 py-5 w-1/5 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @if (!empty($selectedMorningList))
                                    @foreach ($selectedMorningList as $index => $college)
                                        <tr id="{{ $college }}" class="bg-white  cursor-pointer border-b"
                                            data-index="{{ $index }}">
                                            <td class="px-5 py-2 flex justify-start text-base ">{{ $counter }}
                                            </td>
                                            <td scope="row"
                                                class="px-6 py-4 font-normal text-base text-gray-700 whitespace-nowrap">
                                                {{ $college }}
                                            </td>
                                            <td class="px-6 py-4 flex justify-center">
                                                <button wire:click="removeMorningColleges({{ $index }})"
                                                    type="button">
                                                    <x-heroicon-o-trash class="w-6 h-6 text-red-500" />
                                                </button>
                                            </td>
                                        </tr>
                                        @php $counter++; @endphp
                                    @endforeach
                                @else
                                    <tr class="bg-white border-b">
                                        <td colspan=2 scope="row"
                                            class="px-6 py-4 font-normal text-gray-700 whitespace-nowrap">
                                            <p> No preference found! </p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @error('selectedMorningList')
                        <div class="error text-red-600 mt-2">Please select College List</div>
                    @enderror
                </div>
            </div>
        </div>

{{--    @if ( auth()->user()->seat_id == 2 || auth()->user()->seat_id == 3)--}}
{{--        <div class="mb-7 mt-7 bg-white border border-brown-500 rounded-lg"--}}
{{--             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0,0,0,0.03);">--}}
{{--            <div class="p-10">--}}
{{--                --}}{{-- top header --}}
{{--                <div class="grid grid-cols-1 md:grid-cols-2">--}}
{{--                    <div>--}}
{{--                        <p--}}
{{--                                class="text-center md:text-start text-2xl font-medium text-[#333333] tracking-[0.29px] font-roboto">--}}
{{--                            Evening Colleges</p>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                --}}{{-- multiselect --}}
{{--                <div class="mt-5 grid grid-cols-1 md:grid-cols-8 items-center gap-2 md:gap-5">--}}
{{--                    <div class="mb-7 mt-2  md:col-span-6 lg:col-span-7">--}}
{{--                        <span>--}}
{{--                            <label class="font-semibold">Select a College <span class="text-sm text-black float-right">{{count($this->selectedEveningList)}}/{{count($this->nursingEveningColleges)}}</span></label>--}}
{{--                            <x-select class=" mt-1 text-black" style="padding: 8px 12px;box-shadow: none; border: 2px solid gray;"--}}
{{--                                      placeholder="Please select colleges from this drop down"--}}
{{--                                      option-id="id" option-value="name" option-label="name" :options="$this->nursingEveningColleges"--}}
{{--                                      wire:model="selectedEveningList" rightIcon="plus" multiselect/>--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                    --}}{{-- Reset Button --}}
{{--                    <div--}}
{{--                            class="mt-1 flex md:col-span-2 lg:col-span-1 items-center gap-3 justify-center md:justify-end float-right">--}}
{{--                        <button--}}
{{--                                class="py-2 px-5 bg-red-600 text-base text-white font-medium rounded-lg flex items-center gap-3"--}}
{{--                                type="button" wire:click="resetEveningScreen">--}}
{{--                            Reset <span><x-heroicon-s-trash class="h-4 w-4 text-white" /> </span>--}}
{{--                        </button>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                --}}{{-- table --}}
{{--                <div class="mt-5 ">--}}
{{--                    <div class="relative overflow-x-auto shadow sm:rounded-lg">--}}
{{--                        <table id="table_mbbs_id"--}}
{{--                               class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">--}}
{{--                            <thead--}}
{{--                                    class="text-sm text-gray-900 uppercase bg-[#d2dbe2] dark:bg-[#dcdfec] dark:text-gray-500">--}}
{{--                            <tr>--}}
{{--                                <th scope="col" class="px-5 py-2 w-1/5">Preference. No.</th>--}}
{{--                                <th scope="col" class="px-6 py-5 w-3/5">--}}
{{--                                    Name of College--}}
{{--                                </th>--}}
{{--                                <th scope="col" class="px-6 py-5 w-1/5 text-center">--}}
{{--                                    Action--}}
{{--                                </th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @php $counter = 1; @endphp--}}
{{--                            @if (!empty($selectedEveningList))--}}
{{--                                @foreach ($selectedEveningList as $index => $college)--}}
{{--                                    <tr id="{{ $college }}" class="bg-white cursor-pointer border-b"--}}
{{--                                        data-index="{{ $index }}">--}}
{{--                                        <td class="px-5 py-2 flex justify-start text-base">{{ $counter }}</td>--}}
{{--                                        <td scope="row"--}}
{{--                                            class="px-6 py-4 font-normal text-base text-gray-700 whitespace-nowrap">--}}
{{--                                            {{ $college }}--}}
{{--                                        </td>--}}
{{--                                        <td class="px-6 py-4 flex justify-center">--}}
{{--                                            <button wire:click="removeEveningColleges({{ $index }})"--}}
{{--                                                    type="button">--}}
{{--                                                <x-heroicon-o-trash class="w-6 h-6 text-red-500" />--}}
{{--                                            </button>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    @php $counter++; @endphp--}}
{{--                                @endforeach--}}
{{--                            @else--}}
{{--                                <tr class="bg-white border-b">--}}
{{--                                    <td colspan=2 scope="row"--}}
{{--                                        class="px-6 py-4 font-normal text-gray-700 whitespace-nowrap">--}}
{{--                                        <p> No preference found! </p>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endif--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}

{{--                    @error('selectedEveningList')--}}
{{--                    <div class="error text-red-600 mt-2">Please select Evening College List</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}

    <div class="grid grid-cols-2 mb-16">
        <div>
            <button wire:click.prevent="$emit('goToStep', 3)"
                class=" bg-transparent hover:bg-white text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg border-2 border-[#9BABB7]  gap-2"
                    type="button"
                    wire:keydown.enter.prevent="$emit('goToStep', 3)"
            >
                <span class="flex flex-row items-center gap-2 justify-center text-[#687076] font-semibold text-base">
                    <x-heroicon-s-arrow-narrow-left class="w-5 h-5" />
                    Previous Step
                </span>
            </button>
        </div>
        <div class="text-right">
            <button class=" bg-[#3c1fff] hover:bg-[#5345ff] text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg gap-2"
                type="submit">
                <span class="flex flex-row items-center gap-2 justify-center text-white font-semibold text-base">
                    Save & Submit
                    <x-heroicon-s-arrow-narrow-right class="w-5 h-5" />
                </span>
            </button>
        </div>
    </div>
</form>
