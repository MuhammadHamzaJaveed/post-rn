<form wire:submit.prevent="submit">
    <div class="mt-7 mb-7 bg-white rounded-lg"
         style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
        <div>
            <p class="p-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">Personal Details
            </p>
            <hr class="border-t-2 w-full border-[#DAE4EA]">
        </div>

        <div class=" p-5 md:p-10">
            <div class="mb-5 ">
                <div class="flex items-center gap-4 flex-col md:flex-row">
                    <div class="flex flex-col items-start">

                        {{--<img class="w-40 h-40 rounded-full" accept="image/*"
                             src="{{ $errors->has('image') ? asset('images/person-up.svg') : ($image ? (is_string($image) ? $image : $image->temporaryUrl()) : asset('images/person-up.svg')) }}"
                             alt="">--}}
                        {{--<img class="w-40 h-40 rounded-full"
                             src="{{ $errors->has('image')
                        ? asset('images/person-up.svg')
                        : ($image
                            ? (is_string($image)
                                ? $image
                                : asset('storage/uploads/' . $image->hashName()))
                            : asset('images/person-up.svg')) }}"
                             alt="">--}}
                        <img class="w-40 h-40 rounded-full"
                             src="{{ $image instanceof \Livewire\TemporaryUploadedFile
                                ? $image->temporaryUrl()
                                : ($errors->has('image')
                                    ? asset('images/person-up.svg')
                                    : ($image
                                        ? (is_string($image)
                                            ? $image
                                            : asset('storage/uploads/' . $image->hashName()))
                                        : asset('images/person-up.svg'))) }}"
                             alt="">


                    </div>
                    <span class="flex flex-col gap-0 items-center">

                        <div x-data="{ openFileDialog: false }">

                            <button
                                    class="w-[11rem] h-[3rem] bg-[#3c1fff] hover:bg-[#5345ff] py-2 rounded-xl"
                                    type="button" x-on:click="openFileDialog = true; $refs.fileInput.click()">
                                <span
                                        class="flex flex-row tracking-wide items-center gap-2 justify-center text-white font-normal text-lg"
                                        style="font-family: 'Source Sans 3', sans-serif;">
                                    Upload Photo
                                </span>

                            </button>
                            {{--<input x-ref="fileInput" x-show="openFileDialog" wire:model="image" type="file"
                                   name="" id="" x-on:change="openFileDialog = false" hidden>--}}
                            <input
                                    x-ref="fileInput"
                                    x-show="openFileDialog"
                                    wire:model="image"
                                    type="file"
                                    x-on:change="openFileDialog = false"
                                    hidden
                            />
                        </div>

                        <br>

                        <button  type="button"
                                 wire:click="deleteImage"
                                 class=" w-[11rem] h-[3rem] border-2 border-[#BDBDBD] bg-transparent hover:bg-white py-2 rounded-xl">
                            <span
                                    class="flex flex-row tracking-wide items-center gap-2 justify-center text-[#BDBDBD] font-normal text-lg"
                                    style="font-family: 'Source Sans 3', sans-serif;">
                                <x-heroicon-o-trash class="w-6 h-6" />
                                Remove
                            </span>
                        </button>
                    </span>
                </div>
                @error('image')
                <div class="error text-negative-500 text-center md:text-left mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Full Name <span
                                class="text-red-600">*</span></label>
                    <x-input :disabled="auth()->user()->transaction_id ? true : false" placeholder="Enter Your Full Name"
                             class="py-2 px-3 shadow-none outline-none align-middle" wire:model.defer="name"
                             style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                             @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                </div>

                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Father’s Name <span
                                class="text-red-600">*</span></label>
                    <x-input @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }"
                              placeholder="Enter Your Father's Name" wire:model.defer="fatherName"
                             style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12); " />
                </div>


                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Mother’s Name<span
                                class="text-red-600">*</span></label>
                    <x-input  placeholder="Enter Your Mother's Name" wire:model.defer="motherName"
                             class="py-2 px-3 shadow-none outline-none align-middle"
                             style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                             @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                </div>


                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Candidate Mobile Number <span
                                class="text-red-600">*</span></label>
                    <x-input placeholder="0305-153269"
                             mask="['####-#######']"
                             wire:model.defer="mobileNumber" readonly  class="py-2 px-3 shadow-none outline-none align-middle cursor-not-allowed text-gray-500"
                             style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                             @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                </div>


                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Guardian Number
                    </label>
                    <x-inputs.phone placeholder="0305-153269"
                                    mask="['####-#######']"
                                    wire:model.defer="secondaryNumber"
                                    class="py-2 px-3 shadow-none outline-none align-middle"
                                    style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                    @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                </div>


                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Telephone Number </label>
                    <x-inputs.phone label="" mask="['(###) ########','(###) ###-####','####-#######']"
                                    placeholder="(042) 35181887" wire:model.defer="telephoneNumber"
                                    class="py-2 px-3 shadow-none outline-none align-middle"
                                    style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                    @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                </div>



                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Email Address <span
                                class="text-red-600">*</span></label>
                    <x-input mailto:placeholder="sakina.11@gmail.com" wire:model.defer="email"
                             readonly
                             class="py-2 px-3 shadow-none outline-none align-middle cursor-not-allowed text-gray-500"
                             style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                             @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                </div>


                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Gender<span
                                class="text-red-600">*</span></label>
                    <x-select
                            style=" padding: 8px 12px;box-shadow: none;box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                            placeholder="Please select Gender" wire:model.defer="genderId" rightIcon="chevron-down"
                            option-value="id" option-label="name" :options="$this->allGenders"
                            @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                </div>

                {{-- Date --}}
                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Date of Birth <span
                                class="text-red-600">*</span></label>
                    <x-datetime-picker placeholder="select your birth date" wire:model.defer="dob"
                                       class="py-2 px-3 shadow-none outline-none align-middle" display-format="DD-MM-YYYY"
                                       style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" without-time :withoutTimezone="true"
                                       @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                </div>


            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-7 mt-4">
                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Area of Residence <span
                                class="text-red-600">*</span></label>
                    <x-select style="padding: 8px 12px; box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                              placeholder="Please select Residence" wire:model.defer="residenceId" rightIcon="chevron-down"
                              option-value="id" option-label="name" :options="$this->allResidenceAreas"
                              @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                </div>

                <div class="mt-5">
                    <label class="text-black text-lg font-medium font-sans ">Select CNIC/POC/Passport/B-Form <span
                                class="text-red-600">*</span></label>
                    <x-select :options="$this->allCnicPassport" wire:model="cnic" option-value="id" option-label="name"
                              style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                              disabled
                              class="cursor-not-allowed "
                    />
                </div>

                @if (auth()->user()->foreigner == 0 || auth()->user()->foreigner == 1)
                    @if ($showInput == 1)
                        <!-- Non-Foreigner CNIC -->
                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Enter CNIC <span
                                        class="text-red-600">*</span></label>
                            <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter CNIC without dashes"
                                     wire:model.defer="cnic_passport"
                                     type="number"
                                     style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                     readonly
                                     class="py-2 px-3 shadow-none outline-none align-middle cursor-not-allowed text-gray-500"
                            />
                        </div>
                    @elseif ($showInput == 2)
                        <!-- Non-Foreigner B-Form -->
                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Enter B-Form <span
                                        class="text-red-600">*</span></label>
                            <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter B-Form without dashes"
                                     wire:model.defer="cnic_passport"
                                     readonly
                                     class="py-2 px-3 shadow-none outline-none align-middle cursor-not-allowed text-gray-500"
                                     style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number" />
                        </div>
                    @elseif ($showInput == 3)
                        <!-- Non-Foreigner CRC- Child Registration -->
                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">CRC- Child Registration <span
                                        class="text-red-600">*</span></label>
                            <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter CRC without dashes"
                                     wire:model.defer="cnic_passport"
                                     readonly
                                     class="py-2 px-3 shadow-none outline-none align-middle cursor-not-allowed text-gray-500"
                                     style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" type="number" />
                        </div>
                    @endif
                @endif
                @if (auth()->user()->foreigner == 1)
                    @if ($showInput == 4)
                        <!-- Foreigner Passport -->
                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Enter Passport <span
                                        class="text-red-600">*</span></label>
                            <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter here" wire:model.defer="cnic_passport"
                                     readonly
                                     class="py-2 px-3 shadow-none outline-none align-middle cursor-not-allowed text-gray-500"
                                     style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />
                        </div>
                    @elseif ($showInput == 5)
                        <!-- Foreigner POC -->
                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Enter POC <span
                                        class="text-red-600">*</span></label>
                            <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter here" wire:model.defer="cnic_passport"
                                     readonly
                                     class="py-2 px-3 shadow-none outline-none align-middle cursor-not-allowed text-gray-500"
                                     style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />
                        </div>
                    @elseif ($showInput == 6)
                        <!-- Foreigner NICOP -->
                        <div class="mt-5">
                            <label class="text-black text-lg font-medium font-sans ">Enter NICOP <span
                                        class="text-red-600">*</span></label>
                            <x-input :disabled="auth()?->user()?->transaction_id ? true : false" placeholder="Enter here" wire:model.defer="cnic_passport"
                                     readonly
                                     class="py-2 px-3 shadow-none outline-none align-middle cursor-not-allowed text-gray-500"
                                     style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />
                        </div>
                    @endif
                @endif

            </div>


            <div class="mt-4 flex flex-col md:flex-row gap-7">
                <div class="w-full mt-5 md:w-2/4">
                    <div>
                        <label class="text-black text-lg font-medium font-sans ">Residental Address <span
                                    class="text-red-600">*</span></label>
                        <x-input placeholder="Enter your Street Address here.." wire:model.defer="address"
                                 class="py-2 px-3  shadow-none outline-none align-middle"
                                 style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                 @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                    </div>

                </div>
                <div class="w-full mt-5 md:w-1/4">
                    <div>
                        <label class="text-black text-lg font-medium font-sans ">City <span
                                    class="text-red-600">*</span></label>
                        <x-input placeholder="Enter your City" wire:model.defer="city"
                                 class="py-2 px-3 shadow-none outline-none align-middle"
                                 style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                 @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                    </div>

                </div>
                <div class="w-full mt-5 md:w-1/4">
                    <div>
                        <label class="text-black text-lg font-medium font-sans ">Country <span
                                    class="text-red-600">*</span></label>
                        <x-input placeholder="Enter your Country" wire:model.defer="country"
                                 class="py-2 px-3 shadow-none outline-none align-middle"
                                 style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                 @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                    </div>

                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mt-4">
                @if (auth()->user()->foreigner == 0 || auth()->user()->seat_id == 3)
                    <div class="mt-5">
                        <label class="text-black text-lg font-medium font-sans ">District Of Domicile <span
                                    class="text-red-600">*</span></label>
                        <x-select style="padding: 8px 12px;box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                  placeholder="Please Select Your District" wire:model.defer="domicile"
                                  rightIcon="chevron-down" option-value="id" option-label="name" :options="$this->allDomicileDistricts"
                                  @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />

                    </div>
                @endif

                @if (auth()->user()->foreigner == 1)
                    <div class="mt-5">
                        <label class="text-black text-lg font-medium font-sans ">Nationality <span
                                    class="text-red-600">*</span></label>
                        <x-select style="padding: 8px 12px;box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);"
                                  placeholder="Please select Nationality" wire:model.defer="nationalityId"
                                  rightIcon="chevron-down" option-value="id" option-label="name" :options="$this->allNationalities"
                                  @keydown.window.enter="event => { if (event.key === 'Enter') event.preventDefault(); }" />
                    </div>
                @endif
            </div>

        </div>
    </div>
    <div class="grid grid-cols-2 mb-16">
        <div>

            <button wire:click.prevent="$emit('goToStep', 1)" wire:keydown.enter.prevent="$emit('goToStep', 1)"
                    class=" bg-transparent hover:bg-white text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg border-2 border-[#9BABB7]  gap-2 ">
                <span class="flex flex-row items-center gap-2 justify-center text-[#687076] font-semibold text-base">
                    <x-heroicon-s-arrow-narrow-left class="w-5 h-5" />
                    Previous Step
                </span>
            </button>
        </div>
        <div class="text-right">
            <button
                    class=" bg-[#3c1fff] hover:bg-[#5345ff] text-sm px-3 py-2 md:px-6 md:py-3 mb-2 rounded-lg border border-[#5345ff]  gap-2 "
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
