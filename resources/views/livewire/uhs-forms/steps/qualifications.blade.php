<div x-data="{ showAlert: false }">
    <form wire:submit.prevent="submit">
        <div x-data="{ selectedRadio: null }" class="mt-7 mb-7 bg-white rounded-lg"
            style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
            <div>
                <p class=" p-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">
                    Qualifications
                </p>
                <hr class="border-t-2 w-full border-[#DAE4EA]">
            </div>

            <div class="p-5 md:p-10 mb-5">

                <div class="mt-3">
                    <p class="text-red-600 text-base tracking-[0.29px] font-bold font-sans">Aggregate marks in FSc / HSSC
                        /
                        equivalent marks must not be less than 50%<span class="text-red-600">*</span> </p>
                </div>

                <div class="mt-4">
                    <p class="text-gray-700 text-xl tracking-[0.29px] font-bold font-sans">Matric / SSC / 10-Grade /
                        O-Level</p>

                    <div class="mt-9 grid grid-cols-1 md:grid-cols-2 gap-7">
                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Examination Passed (SSC)<span
                                    class="text-red-600">*</span></label>
                            <x-select style="padding: 8px 8px;"
                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                placeholder="Please Select Examination Passed" wire:model.defer="sscPassed"
                                rightIcon="chevron-down" option-value="id" option-label="name" :options="$this->sscExams" />
                        </div>
                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Subjects
                                {{--<span class="text-red-600">*</span>--}}
                            </label>
                            <x-input wire:model.defer="sscScienceSubjects" placeholder="Enter Subjects"
                                     style="padding: 8px 8px;"
                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />

                        </div>

                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Institution Type <span
                                    class="text-red-600">*</span></label>
                            <x-select style="padding: 8px 8px;"
                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                placeholder="Please Select Institution Type" wire:model.defer="sscInstitutionType"
                                rightIcon="chevron-down" option-value="id" option-label="name"
                                      :options="$this->getAllInstitutionTypes"
                            />

                        </div>

                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Board / University <span
                                    class="text-red-600">*</span></label>
                            <x-select style="padding: 8px 8px;"
                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                placeholder="Please Select Your Board of Education" wire:model.defer="sscBoard"
                                rightIcon="chevron-down" option-value="id" option-label="name" :options="$this->allBoards" />

                        </div>
                        <div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                                <div class="mt-5">
                                    <label class="text-black text-lg font-medium font-sans ">Choose Year Of Passing <span
                                                class="text-red-600">*</span></label>
                                    <x-select wire:model.defer="sscPassingYear" placeholder="Choose Year" :options="[
                                        '2000',
                                        '2001',
                                        '2002',
                                        '2003',
                                        '2004',
                                        '2005',
                                        '2006',
                                        '2007',
                                        '2008',
                                        '2009',
                                        '2010',
                                        '2011',
                                        '2012',
                                        '2013',
                                        '2014',
                                        '2015',
                                        '2016',
                                        '2017',
                                        '2018',
                                        '2019',
                                        '2020',
                                        '2021',
                                        '2022',
                                    ]"
                                              style="padding: 8px 8px;" rightIcon="chevron-down"
                                              style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />

                                </div>
                                <div class="mt-5">
                                    <label class="text-black text-lg font-medium font-sans ">Roll No <span
                                                class="text-red-600">*</span></label>
                                    <x-input wire:model.defer="sscRollNo" style="padding: 8px 8px;"
                                             style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number" />

                                </div>

                            </div>
                        </div>

                        <div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                                <div class="mt-5">
                                    <label class="text-black text-lg font-medium font-sans ">Marks Obtained <span
                                                class="text-red-600">*</span></label>
                                    <x-input wire:model.defer="sscMarksObtained"
                                             style="padding: 8px 8px; box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                             x-on:click="showAlert = true" type="number">
                                    </x-input>

                                </div>
                                <div class="mt-5">
                                    <label class="text-black text-lg font-medium font-sans ">Total Marks <span
                                                class="text-red-600">*</span></label>
                                    <x-input wire:model.defer="sscTotalMarks" style="padding: 8px 8px;"
                                             style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number" />

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-9">
                    <p class="text-gray-700 text-xl tracking-[0.29px] font-bold font-sans">FSc / HSSC / 12-Grade /
                        A-Level</p>

                    <div class="mt-9 grid grid-cols-1 md:grid-cols-2 gap-7">
                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Examination Passed (HSSC) <span
                                    class="text-red-600">*</span></label>
                            <x-select style="padding: 8px 8px;"
                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                placeholder="Please Select Examination Passed" wire:model.defer="hsscPassed"
                                rightIcon="chevron-down" option-value="id" option-label="name" :options="$this->allExams" />

                        </div>

                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Subjects
                            </label>
                            <x-input wire:model.defer="hsscScienceSubjects" placeholder="Enter Subjects"
                                 style="padding: 8px 8px;"
                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />

                        </div>

                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Institution Type <span
                                    class="text-red-600">*</span></label>
                            <x-select style="padding: 8px 8px;"
                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                placeholder="Please Select Institution Type" wire:model.defer="hsscInstitutionType"
                                rightIcon="chevron-down" option-value="id" option-label="name" :options="$this->getAllInstitutionTypes" />

                        </div>


                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Board / University <span
                                    class="text-red-600">*</span></label>
                            <x-select style="padding: 8px 8px;"
                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                placeholder="Please Select Your Board of Education" wire:model.defer="hsscBoard"
                                rightIcon="chevron-down" option-value="id" option-label="name" :options="$this->allBoards" />

                        </div>
                        <div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                                <div class="mt-5">
                                    <label class="text-black text-lg font-medium font-sans ">Choose Year Of Passing <span
                                                class="text-red-600">*</span></label>
                                    <x-select wire:model="hsscPassingYear" placeholder="Choose Year" :options="[
                                        '2000',
                                        '2001',
                                        '2002',
                                        '2003',
                                        '2004',
                                        '2005',
                                        '2006',
                                        '2007',
                                        '2008',
                                        '2009',
                                        '2010',
                                        '2011',
                                        '2012',
                                        '2013',
                                        '2014',
                                        '2015',
                                        '2016',
                                        '2017',
                                        '2018',
                                        '2019',
                                        '2020',
                                        '2021',
                                        '2022',
                                        '2023',
                                        '2024',
                                    ]"
                                              style="padding: 8px 8px;" rightIcon="chevron-down"
                                              style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />

                                </div>
                                <div class="mt-5">
                                    <label class="text-black text-lg font-medium font-sans ">Roll No <span
                                                class="text-red-600">*</span></label>
                                    <x-input wire:model.defer="hsscRollNo" style="padding: 8px 8px;"
                                             style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number" />

                                </div>

                            </div>
                        </div>
                        <div x-data="{ showAlert: false, popupShown: false }">
                            

                            @if($hsscPassingYear == '2021')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                                    <div class="mt-5">
                                        <label class="text-black text-lg font-medium font-sans ">Physics/Math Obtained <span
                                                    class="text-red-600">*</span></label>
                                        <x-input wire:model.defer="physcisObtained"
                                                style="padding: 8px 8px; box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                                x-on:click="showAlert = true" type="number">
                                        </x-input>

                                    </div>

                                    <div class="mt-5">
                                        <label class="text-black text-lg font-medium font-sans ">Biology Obtained <span
                                                    class="text-red-600">*</span></label>
                                        <x-input wire:model.defer="biologyObtained" style="padding: 8px 8px;"
                                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number"/>

                                    </div>

                                    <div class="mt-5">
                                        <label class="text-black text-lg font-medium font-sans ">Chemistery Obtained <span
                                                    class="text-red-600">*</span></label>
                                        <x-input wire:model.defer="chemisteryObtained" style="padding: 8px 8px;"
                                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number"/>

                                    </div>
                                </div>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                                    <div class="mt-5">
                                        <label class="text-black text-lg font-medium font-sans ">Marks Obtained <span
                                                    class="text-red-600">*</span></label>
                                        <x-input wire:model.defer="hsscMarksObtained"
                                                style="padding: 8px 8px; box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                                x-on:click="showAlert = true" type="number">
                                        </x-input>

                                    </div>

                                    <div class="mt-5">
                                        <label class="text-black text-lg font-medium font-sans ">Total Marks <span
                                                    class="text-red-600">*</span></label>
                                        <x-input wire:model.defer="hsscTotalMarks" style="padding: 8px 8px;"
                                                style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number"/>

                                    </div>
                                </div>
                            @endif

                            <div x-show="showAlert && !popupShown"
                                 class="fixed inset-0 flex items-center justify-center z-50 mx-5">
                                <div class="fixed inset-0 bg-black opacity-50"></div>
                                <div class="relative">
                                    <div id="modal"
                                         class="rounded-xl p-5 pt-12 pb-12 md:p-12 bg-gray-300 font-sans text-red-500"
                                         @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }">
                                        <!-- Close button -->
                                        <button
                                                class="absolute top-0 right-0 mt-2 mr-2 text-gray-600 hover:text-red-600"
                                                @click="showAlert = false; popupShown = true" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path
                                                        d="M3.854 3.146a.5.5 0 0 1 .708 0L8 7.293l3.438-3.437a.5.5 0 1 1 .708.708L8.707 8l3.437 3.438a.5.5 0 0 1-.708.708L8 8.707l-3.437 3.437a.5.5 0 0 1-.708-.708L7.293 8 3.854 4.562a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </button>
                                        <div class="flex flex-col items-center gap-5">
                                            <span class="text-red-600 font-medium text-lg">Note: </span>
                                            <p class="text-base font-medium text-gray-800">Minimum marks to qualify
                                                for
                                                admission should be 60%.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-2 mb-16">

            <div>
            <button wire:click.prevent="$emit('goToStep', 2)"
                class="bg-transparent hover:bg-white text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg border-2 border-[#9BABB7] gap-2"
                type="button"
                wire:keydown.enter.prevent="$emit('goToStep', 2)">
                <span class="flex flex-row items-center gap-2 justify-center text-[#687076] font-semibold text-base">
                    <x-heroicon-s-arrow-narrow-left class="w-5 h-5" />
                    Previous Step
                </span>
            </button>
            </div>

            <div class="text-right">
            <button wire:click.prevent="submit"

                    class=" bg-[#3c1fff] hover:bg-[#5345ff] text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg border border-[#5345ff]  gap-2 "
                type="button"
                wire:keydown.enter.prevent="submit">
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
