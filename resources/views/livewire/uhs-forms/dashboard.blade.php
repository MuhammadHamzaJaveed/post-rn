<div>
    <style>
        .ct-animate-blink {
            animation: blink 1.5s infinite;
            animation-fill-mode: both;
        }

        @keyframes blink {
            0% { opacity: 0 }
            50% { opacity: 1 }
            100% { opacity: 0 }
        }
    </style>
    <div class="mt-7 mb-5 bg-white rounded-xl p-3"
         style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
        <div class="grid grid-cols-1 md:grid-cols-6">
            <div class="col-span-6 flex justify-center md:flex md:justify-start md:col-span-1">
                @if(!empty($image))
                    <img src="{{ $image }}" alt="profile-dashboard"
                        class="w-60 h-60 md:w-44 md:h-44 object-cover rounded-2xl object-center">
                @endif
            </div>
            <div class="col-span-5 p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <p class=" font-semibold text-2xl text-center md:text-start"> {{ auth()->user()->name }} </p>
                    </div>
                    <div class="grid grid-cols-1 xl:grid-cols-3 lg:grid-cols-2 gap-3">
                        @if(empty(auth()->user()->transaction_id) && empty(auth()->user()->is_paid))
                            <div wire:click="downloadChallan({{ config('envdata.challan_type_id') }})"
                                class="bg-[#5345ff] text-center items-center cursor-pointer flex justify-center border-2 border-[#3c1fff] rounded-lg">
                                <span class="text-[#ffff] text-sm  md:text-lg font-medium py-1">Download Challan</span>
                            </div>
                        @endif

                        <x-button style="border-radius: 8px;background: #3c1fff" teal href="{{ route('uhs-form-application-status') }}">
                            <span class="text-white  text-sm  md:text-lg font-medium py-1">My Application</span>
                        </x-button>

                        <x-button teal type="button" wire:click="redirectToOTPVerification" style="border-radius: 8px;background: #3c1fff" >
                            <span class="text-white text-xs  md:text-sm xl:text-lg font-medium py-1 ">
                                Edit the form
                                <span wire:loading wire:target="submit">
                                    <p class="flex"><x-loader /></p>
                                </span>
                            </span>
                        </x-button>

                    </div>
                </div>
                @if(!empty($personalDetails))
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-8 gap-5">
                        <div class="flex flex-col items-start justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Cnic Number
                            </label>
                            <p class="text-lg font-semibold">{{ $personalDetails->cnic_passport }}</p>
                        </div>
                        <div class="flex flex-col items-start justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Gender
                            </label>
                            <p class="text-lg font-semibold">{{ $personalDetails->gender->name }}</p>
                        </div>
                        <div class="flex flex-col items-start justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Contact No.
                            </label>
                            <p class="text-lg font-semibold">{{ $personalDetails->mobile_number }}</p>
                        </div>
                    </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-8 gap-5">
                    <div class="flex flex-col items-start justify-start">
                        <label class="text-[#8B939B] font-normal text-base">
                            Email
                        </label>
                        <p class="text-lg font-semibold">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="flex flex-col items-start justify-start">
                        @if(auth()->user()->foreigner == 0)
                            <div class="flex flex-col col-span-2 items-start ">
                                {{-- <label class="text-[#8B939B] font-normal text-base">
                                    Total Aggregate (MDCAT)
                                </label>
                                <p class="text-lg font-semibold">{{ auth()->user()->aggregate }}</p> --}}
                            </div>
                        @endif

                        @if(auth()->user()->foreigner == 1)
                            <div class="flex flex-col col-span-2 items-start ">
                                {{-- <label class="text-[#8B939B] font-normal text-base">
                                    Total Aggregate (Overseas)
                                </label>
                                <p class="text-lg font-semibold">{{ auth()->user()->aggregate_overseas }}</p> --}}
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col items-start justify-start">
                        <label class="text-[#8B939B] font-normal text-base">
                            Application ID
                        </label>
                        <div class="flex flex-col gap-4">

                        </div>
                        <p class="text-lg font-semibold"><span class="ct-animate-blink text-2xl font-serif lining-nums font-extrabold text-teal-700">{{auth()->id()}}</span></p>
                    </div>
                    <div class="flex flex-col items-start justify-start">
                        <label class="text-[#8B939B] font-normal text-base">
                            Challan No
                        </label>
                        <div class="flex flex-col gap-4">

                        </div>
                        <p class="text-lg font-semibold">
                            <span class="text-2xl font-serif lining-nums font-extrabold text-black-700">
                                {{ auth()->user()->challan_id }}
                            </span>
                        </p>
                    </div>
                    <div class="flex flex-col items-start justify-start">
                        <label class="text-[#8B939B] font-normal text-base">
                            Challan Status
                        </label>
                        <div class="flex flex-col gap-4">

                        </div>
                        @if ($challanStatus)
                            <p class="text-lg font-semibold">
                                <span class="text-2xl font-serif lining-nums font-extrabold text-success-700">
                                    Paid
                                </span>
                            </p>
                        @else
                            <p class="text-lg font-semibold">
                                <span class="text-2xl font-serif lining-nums font-extrabold text-danger-700">
                                    Pending
                                </span>
                            </p>
                        @endif
                    </div>
                    <div class="flex flex-col items-start justify-start">
                        <label class="text-[#8B939B] font-normal text-base">
                            Application Status
                        </label>
                        <div class="flex flex-col gap-4">

                        </div>
                        @if (auth()->user()->is_completed == 1)
                            <p class="text-lg font-semibold">
                                <span class="text-2xl font-serif lining-nums font-extrabold text-success-700">
                                    Completed
                                </span>
                            </p>
                        @else
                            <p class="text-lg font-semibold">
                                <span class="text-2xl font-serif lining-nums font-extrabold text-danger-700">
                                    Pending
                                </span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>

    <form wire:submit.prevent="submit">
        <div class="mb-10 bg-white pb-10 rounded-lg"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
            <div>
                <p class=" px-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">
                    Upload Challan</p>
                <hr class="border-t-2 w-full border-[#DAE4EA]">
            </div>
            @if (auth()->user()->userChallanImage == null && !$challanSubmitted)
               @if(auth()->user()->userChallanImage == null)
                <div class="p-5 md:p-10 ">
                    <div>
                        <p class="text-2xl font-semibold text-center">Upload Your Paid Challan Here</p>
                    </div>
                    <div class="mt-5">
                        <p class="text-lg font-normal text-[#6B8097] text-center">Please upload the clear picture of
                            your paid
                            challan here to <br>complete the application processs</p>
                    </div>
                    @else
                        <div class="mt-20 mb-10">
                            <p class="text-center text-2xl font-bold text-green-700">Paid Challan copy has been submitted.</p>
                        </div>
                    @endif

                    <div class="mt-8 flex justify-center">
                        <div class="flex flex-col w-11/12 justify-center items-center">

                            <div
                                    class="w-full p-4 bg-[#F0F4F680] bg-whtie m-auto rounded-lg border-2 border-dashed border-[#6B8097B2]">
                                <div>
                                    <svg class="mx-auto mb-2 mt-2" xmlns="http://www.w3.org/2000/svg" width="82"
                                         height="78" viewBox="0 0 82 78" fill="none">
                                        <ellipse cx="41.2584" cy="39.1062" rx="40.3463" ry="38.824"
                                                 fill="#148DCB" />
                                        <path
                                                d="M55.6779 55.7019H45.2904V45.6016H48.7233C49.5938 45.6016 50.1083 44.6497 49.5938 43.9643L42.9162 35.073C42.4908 34.5018 41.6103 34.5018 41.1849 35.073L34.5072 43.9643C33.9928 44.6497 34.4973 45.6016 35.3778 45.6016H38.8106V55.7019H27.1766C21.9829 55.4258 17.8477 50.7517 17.8477 45.6873C17.8477 42.1936 19.8163 39.1474 22.7347 37.5005C22.4676 36.8056 22.3291 36.063 22.3291 35.2824C22.3291 31.7126 25.3267 28.8282 29.0365 28.8282C29.8378 28.8282 30.6094 28.9614 31.3316 29.2185C33.4784 24.8395 38.1082 21.8027 43.4899 21.8027C50.4545 21.8123 56.1924 26.9433 56.8453 33.4832C62.1973 34.3686 66.2633 39.1379 66.2633 44.5355C66.2633 50.3043 61.5939 55.3021 55.6779 55.7019Z"
                                                fill="white" />
                                    </svg>
                                    {{--<div class="mx-auto w-4/5">
                                        <x-filepond.filepond file="{{ $challan }}" allowFileImagePreview
                                                             name="challan" required id="challan_id" wire:model="challan"
                                                             acceptedFileTypes="['image/*']" />
                                    </div>--}}
                                    <div class="flex justify-center items-center">
                                        <x-dynamic-file-upload
                                                inputHeading="Only Jpg or Jpeg"
                                                label="Upload Your Paid Challan"
                                                class="w-full"
                                                name="challan"
                                                :filePath="auth()->user()->userChallanImage?->path ?? ''"
                                                :fileName="auth()->user()->userChallanImage?->name ?? ''"
                                        />
                                    </div>

                                    <div class="mt-2">
                                        <p class="font-medium text-xs text-center text-[#00000066]">JPG or
                                            JPEG, file size
                                            no
                                            more than 1MB</p>
                                    </div>

                                    @error('challan')
                                    <div class="text-center error text-red-600 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 mb-10 flex flex-row justify-center">
                        <x-button type="submit" style="width: 200px;border-radius: 12px;background: #3c1fff" lg>
                            <span class="flex justify-content-center">
                                <span
                                        class="text-white font-medium text-base flex flex-row items-center justify-between">
                                    <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 40 41" fill="none">
                                        <path
                                                d="M15.1127 19.3314C14.3546 18.5732 13.2174 18.5732 12.4592 19.3314C11.7011 20.0895 11.7011 21.2267 12.4592 21.9849L18.1453 27.671C18.5244 28.05 18.9035 28.2396 19.4721 28.2396C20.0407 28.2396 20.4198 28.05 20.7988 27.671L34.0664 12.508C34.635 11.5604 34.635 10.4231 33.6873 9.85453C32.9291 9.28592 31.7919 9.28592 31.2233 10.0441L19.4721 23.5012L15.1127 19.3314Z"
                                                fill="white" />
                                        <path
                                                d="M36.5295 18.7622C35.3922 18.7622 34.6341 19.5203 34.6341 20.6575C34.6341 28.9971 27.8108 35.8204 19.4712 35.8204C11.1316 35.8204 4.3083 28.9971 4.3083 20.6575C4.3083 16.6772 5.82459 12.8865 8.66764 10.0435C11.5107 7.01088 15.3014 5.49459 19.4712 5.49459C20.6084 5.49459 21.9352 5.68413 23.0724 5.87366C24.0201 6.25274 25.1573 5.68413 25.5364 4.54691C25.9154 3.40969 25.1573 2.65154 24.2096 2.27247H24.0201C22.5038 1.89339 20.9875 1.70386 19.4712 1.70386C9.04671 1.70386 0.517578 10.233 0.517578 20.8471C0.517578 25.775 2.60248 30.703 6.01413 34.1146C9.61532 37.7158 14.3537 39.6112 19.2817 39.6112C29.7062 39.6112 38.2353 31.082 38.2353 20.6575C38.4248 19.5203 37.4771 18.7622 36.5295 18.7622Z"
                                                fill="white" />
                                    </svg> Submit </span>
                            </span>
                        </x-button>
                    </div>

                </div>

            @else
                    <div class="mt-20 mb-10">
                        <p class="text-center text-2xl font-bold text-green-700">Paid Challan copy has been submitted.</p>
                    </div>
            @endif
        </div>
    </form>

    <div class="mb-10 bg-white pb-10 rounded-lg" style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
        <div>
            <p class=" px-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">
                Application Status
            </p>
            <hr class="border-t-2 w-full border-[#DAE4EA]">
        </div>
        @if (auth()->user()->is_completed == 1)
            <div class="mt-20 mb-10">
                <p class="text-center text-2xl font-bold text-teal-700">
                    Your application has been submitted.
                </p>
            </div>
        @else
            <div class="mt-5 mb-10 px-5">
                <p class="text-center text-red-500 text-2xl font-bold">
                    The application is now prepared for submission.
                    Prior to proceeding with the submission,
                    it is strongly advised that you thoroughly review the application.
                    It is recommended that you download and print the application,
                    along with all uploaded documents, to verify its completeness and accuracy.
                    Once you are fully satisfied that the application is accurate and complete in all respects,
                    you may proceed with its submission.
                </p>

                <p class="text-center text-red-500 text-2xl font-bold">
                    Please note that your application will remain incomplete until the fee is deposited and the final submission is made.
                </p>
            </div>
            <div class="mt-10 mb-10 flex flex-row justify-center">
                <x-button wire:click="finalSubmit" type="submit" red style="width: 200px;border-radius: 12px" lg>
                    <span class="flex justify-content-center">
                        <span class="text-white font-medium text-base flex flex-row items-center justify-between">
                            Final Submit
                        </span>
                    </span>
                </x-button>
            </div>
        @endif
    </div>
</div>
<script>
    Livewire.on('challanUploaded', () => {
        window.location.reload();
    });
    Livewire.on('finalSubmit', () => {
        window.location.reload();
    });
</script>