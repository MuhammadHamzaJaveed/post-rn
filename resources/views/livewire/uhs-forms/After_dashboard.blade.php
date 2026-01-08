<div>
    <style>
        .ct-animate-blink {
            animation: blink 1.5s infinite;
            animation-fill-mode: both;
        }

        @keyframes blink {
            0% {
                opacity: 0
            }

            50% {
                opacity: 1
            }

            100% {
                opacity: 0
            }
        }
    </style>
    @php
    $studentPath = auth()->user()
    ->meritListFromCollege()
    ->where('college_to',$selectedCollegeId)
    ->where('user_id',auth()->user()->id)
    ->first();
        if(boolval($isStay)){
            $college_from = '';
            $merit_list_college = \App\Models\MeritListFromCollege::query()
                ->where('user_id',auth()->user()->id)
                ->where('is_stay',1)
                ->first();
            $college_to = \App\Models\College::where('id',$selectedCollegeId)->first();
        } else {
        $merit_list_college =
            isset($selectionList->meritListFromCollege) && count($selectionList->meritListFromCollege) > 0
                ? $selectionList->meritListFromCollege[0]
                : '';
            $college_from =
            isset($selectionList->meritListFromCollege) && count($selectionList->meritListFromCollege) > 0
                ? $selectionList->meritListFromCollege[0]->college_from
                : '';
        $college_to =
            isset($selectionList->meritListFromCollege) && count($selectionList->meritListFromCollege) > 0
                ? $selectionList->meritListFromCollege[0]->college
                : '';
        }

    @endphp
    <div class="mt-7 mb-5 bg-white rounded-xl p-3"
         style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
        <div class="grid grid-cols-1 md:grid-cols-6">
            <div>
                <div class=" col-span-6 flex justify-center md:flex md:justify-start md:col-span-1">
                    <p class="text-white">sk</p> <img src="{{ $image }}" alt="profile-dashboard"
                                                      class="w-60 h-60 md:w-44 md:h-44 object-cover rounded-2xl object-center">
                </div>
            </div>
            <div class="col-span-5 p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <p class=" font-semibold text-2xl text-center md:text-start"> {{ auth()->user()->name }} </p>
                    </div>
                    <div class="grid grid-cols-1 xl:grid-cols-1 lg:grid-cols-1 gap-3">

                        {{-- <x-button style="border-radius: 8px" teal href="{{ route('uhs-form-application-status') }}">
                            <span class="text-white text-sm  md:text-lg font-medium py-1">My Application</span>
                        </x-button> --}}

                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="w-1/2  md:p-4 ">
                        <div class="flex flex-col pt-4 items-start justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Gender
                            </label>
                            <p class="text-lg font-semibold">{{ $personalDetails->gender->name }}</p>
                        </div>

                        <div class="flex flex-col items-start pt-4 justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Cnic Number
                            </label>
                            <p class="text-lg font-semibold">{{ $personalDetails->cnic_passport }}</p>
                        </div>


                        <div class="flex flex-col items-start pt-4 justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Contact No.
                            </label>
                            <p class="text-lg font-semibold">{{ $personalDetails->mobile_number }}</p>
                        </div>
                    </div>
                    <div class="w-1/2 md:p-4">
                        <div class="flex flex-col col-span-1 pt-4 items-start justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Email
                            </label>
                            <p class="md:text-lg md:font-semibold">{{ auth()->user()->email }}</p>
                        </div>


                        @if (!in_array(5, $seatCategories))
                            <div class="flex flex-col col-span-2 pt-4 items-start ">
                                <label class="text-[#8B939B] md:font-normal text-base">
                                    Aggregate(MDCAT)
                                </label>
                                <p class="md:text-lg md:font-semibold">{{ auth()->user()->aggregate }}</p>
                            </div>
                        @endif

                        @if (in_array(5, $seatCategories))
                            <div class="flex flex-col col-span-2 pt-4 items-start ">
                                <label class="text-[#8B939B] font-normal text-base">
                                    Aggregate(Overseas)
                                </label>
                                <p class="md:text-lg md:font-semibold">{{ auth()->user()->aggregate_overseas }}</p>
                            </div>
                        @endif

                        {{--<div class="flex flex-col col-span-2 pt-4 items-start ">
                            <label class="text-[#8B939B] font-normal text-base">
                                Application Fee
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
                                        Unpaid
                                    </span>
                                </p>
                            @endif
                        </div>--}}

                        {{--<div class="flex flex-col col-span-1 pt-4 items-start justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Admission Fee
                            </label>
                            <p class="md:text-lg md:font-semibold">
                            @if (auth()->user()->admission_is_paid > 0)
                                <p class="text-lg font-semibold">
                                        <span class="text-2xl font-serif lining-nums font-extrabold text-success-700">
                                            Paid
                                        </span>
                                </p>
                            @else
                                <p class="text-lg font-semibold">
                                        <span class="text-2xl font-serif lining-nums font-extrabold text-danger-700">
                                            Unpaid
                                        </span>
                                </p>
                                @endif
                                </p>
                        </div>--}}
                    </div>

                    <div class="w-1/2 md:p-4">
                        {{--<div class="flex flex-col col-span-1 pt-4 items-start justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Admission Fee
                            </label>
                            <p class="md:text-lg md:font-semibold">
                            @if (auth()->user()->admission_is_paid > 0)
                                <p class="text-lg font-semibold">
                                        <span class="text-2xl font-serif lining-nums font-extrabold text-success-700">
                                            Paid
                                        </span>
                                </p>
                            @else
                                <p class="text-lg font-semibold">
                                        <span class="text-2xl font-serif lining-nums font-extrabold text-danger-700">
                                            Unpaid
                                        </span>
                                </p>
                                @endif
                                </p>
                        </div>--}}

                        <div class="flex flex-col col-span-1 pt-4 items-start justify-start">
                            <label class="text-[#8B939B] font-normal text-base">
                                Status
                            </label>
                            <span
                                    class="ct-animate-blink text-2xl font-serif lining-nums font-extrabold text-green-700">
                                @if (isset($college_to))
                                    <p class="md:text-3xl text-green-600 md:font-semibold pt-4">Selected</p>
                                @else
                                    <p class="md:text-3xl text-red-600 md:font-semibold pt-4">Not Selected</p>
                                @endif
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{--@if (!empty($college_to))--}}
        <div class="mt-7 mb-5 bg-white rounded-xl p-3"
             style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
            <div>
                <p class="p-5 md:px-5 md:py-2 text-2xl font-medium text-red-600 tracking-[0.29px] font-sans">
                    Selection Details
                </p>
                <hr class="border-t-2 w-full border-[#DAE4EA]">
            </div>
            <div class="shadow-lg my-8 rounded-lg overflow-hidden mx-4 md:mx-10">
                <table class="w-full table-fixed">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">List</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Seat</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">College</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Date</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Joined Status</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Stay Status</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Upgrade Status</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($allUserColleges as $colleges)
                        <tr>
                            <td class="py-4 px-6 border-b border-gray-200">{{ $colleges?->selectionList?->name }}</td>
                            <td class="py-4 px-6 border-b border-gray-200">{{ $colleges?->seat?->name }}</td>
                            <td class="py-4 px-6 border-b border-gray-200 truncate">{{\App\Models\College::where('id',$colleges->college_to)?->first()?->name}}</td>
                            <td class="py-4 px-6 border-b border-gray-200">{{ date('d-M-Y',strtotime($colleges?->updated_at))}}</td>
                            <td class="py-4 px-6 border-b border-gray-200">
                                <span class="@if($colleges?->is_joined) bg-green-500 @else bg-gray-500 @endif text-white text-md py-1 px-2 rounded-full">{{$colleges?->is_joined ? 'Joined': 'Pending' }}</span>
                            </td>
                            <td class="py-4 px-6 border-b border-gray-200">
                                <span class="@if($colleges?->is_stay) bg-green-500 @else bg-gray-500 @endif text-white text-md py-1 px-2 rounded-full ">{{$colleges?->is_stay ? 'Stay': 'Pending' }}</span>
                            </td>
                            <td class="py-4 px-6 border-b border-gray-200">
                                @if(
                                       boolval($colleges?->is_stay)
                                    && boolval($colleges?->is_joined))
                                        <span class="bg-warning-500 text-white text-sm py-1 px-2 rounded-full">
                                        Current College
                                        </span>
                                    @else
                                        @if(boolval($colleges?->is_joined))
                                        <span class="bg-blue-500 text-white text-md py-1 px-2 rounded-full">
                                        Upgraded
                                        </span>
                                    @else
                                        <span class="text-black text-md py-1 px-2 rounded-full">
                                        -
                                        </span>
                                        @endif
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--<div class="grid grid-cols-1 md:grid-cols-6">
                <div class="col-span-5 p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    </div>

                   --}}{{-- @if (!empty($college_from) && $college_from > 0)
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-5 justify-between mt-8 ">
                            <div class="flex flex-col items-start justify-start">
                                <label class="text-[#8B939B] font-normal text-base">
                                    From College
                                </label>
                                <p class="text-lg font-semibold">
                                    <span class="text-2xl font-serif lining-nums font-extrabold">
                                        {{ \App\Models\College::where('id', $college_from)->value('name') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endif

                    @if (!empty($college_to))
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-5 justify-between mt-8 ">
                            <div class="flex flex-col items-start justify-start">
                                <label class="text-[#8B939B] font-normal text-base">
                                    @if (!empty($college_from) && $college_from > 0)
                                        To
                                    @endif
                                    College
                                </label>
                                <p class="text-lg font-semibold">
                                    <span
                                            class="ct-animate-blink text-2xl font-serif lining-nums font-extrabold text-green-700">
                                        {{ $college_to->name }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-5 justify-between mt-8 ">
                            <div class="flex flex-col items-start justify-start">
                                <label class="text-[#8B939B] font-normal text-base">
                                    College
                                </label>
                                <p class="text-lg text-red-600 font-semibold">Not Selected</p>
                            </div>
                        </div>
                    @endif--}}{{--
                </div>
            </div>--}}
        </div>
        @if (isset($college_to) && !empty($college_to) && $college_to->id > 0 || true)
            {{--<form wire:submit.prevent="submit">
                <div class="mb-10 bg-white pb-10 rounded-lg"
                     style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
                    <div>
                        <p class=" px-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">
                            Upload Admission Challan
                        </p>
                        <hr class="border-t-2 w-full border-[#DAE4EA]">
                    </div>
                    <div class="p-5 md:p-10 ">
                        <div>
                            <div>
                                <p
                                        class=" p-5  md:px-5 md:py-4 text-2xl font-medium text-black-600 tracking-[0.29px] font-sans">
                                    Instructions</p>
                            </div>
                            <ol>
                                <li class="pt-3 text-lg font-normal flex flex-row">
                                    <span class="text-blue-900  pr-3">
                                        <x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800"/>
                                    </span>
                                    Submit Fees
                                    <span class="font-bold ml-2">
                                        Pay the challan before the due date to secure your admission.
                                    </span>
                                </li>
                                <li class="pt-3 text-lg font-normal flex flex-row">
                                    <span class="text-blue-900  pr-3">
                                        <x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800"/>
                                    </span>
                                    Upload the paid challan copy.
                                </li>
                            </ol>
                        </div>
                        @if (auth()->user()->userAdmissionChallanImage == null)
                            <!-- <div>
                                <p class="text-2xl font-semibold text-center">Upload Your Paid Challan Here</p>
                            </div> -->
                            <div class="mt-5">
                                <p class="text-lg font-normal text-red-500 text-center">
                                    Please upload the clear picture of your paid challan here to
                                    <br>
                                    complete the application processs
                                </p>
                            </div>
                        @else
                            <div class="mt-5">
                                <p class="text-xl text-[#15803D] font-bold text-center">
                                    Your paid challan image is submitted successfully
                                </p>
                            </div>
                        @endif
                        <div class="mt-8 flex justify-center">
                            <div class="flex flex-col w-11/12 justify-center items-center">
                                <div
                                        class="w-full p-4 bg-[#F0F4F680] bg-whtie m-auto rounded-lg border-2 border-dashed border-[#6B8097B2]">
                                    <div>
                                        <svg class="mx-auto mb-2 mt-2" xmlns="http://www.w3.org/2000/svg"
                                             width="82" height="78" viewBox="0 0 82 78" fill="none">
                                            <ellipse cx="41.2584" cy="39.1062" rx="40.3463" ry="38.824"
                                                     fill="#148DCB"/>
                                            <path
                                                    d="M55.6779 55.7019H45.2904V45.6016H48.7233C49.5938 45.6016 50.1083 44.6497 49.5938 43.9643L42.9162 35.073C42.4908 34.5018 41.6103 34.5018 41.1849 35.073L34.5072 43.9643C33.9928 44.6497 34.4973 45.6016 35.3778 45.6016H38.8106V55.7019H27.1766C21.9829 55.4258 17.8477 50.7517 17.8477 45.6873C17.8477 42.1936 19.8163 39.1474 22.7347 37.5005C22.4676 36.8056 22.3291 36.063 22.3291 35.2824C22.3291 31.7126 25.3267 28.8282 29.0365 28.8282C29.8378 28.8282 30.6094 28.9614 31.3316 29.2185C33.4784 24.8395 38.1082 21.8027 43.4899 21.8027C50.4545 21.8123 56.1924 26.9433 56.8453 33.4832C62.1973 34.3686 66.2633 39.1379 66.2633 44.5355C66.2633 50.3043 61.5939 55.3021 55.6779 55.7019Z"
                                                    fill="white"/>
                                        </svg>
                                        <div class="mx-auto w-4/5">
                                            <x-filepond.filepond file="{{ $admissionChallan }}" allowFileImagePreview
                                                                 size="1024*1024"
                                                                 name="admissionChallan" required
                                                                 id="admissionChallan_id"
                                                                 wire:model="admissionChallan"
                                                                 acceptedFileTypes="['image/*']"/>
                                        </div>
                                        <div class="mt-2">
                                            <p class="font-medium text-xs text-center text-[#00000066]">
                                                JPG, PNG or JPEG, file size no more than 1MB
                                            </p>
                                        </div>
                                        @error('challan')
                                        <div class="text-center error text-red-600 mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 flex flex-row justify-center">
                            <x-button type="submit" blue style="width: 200px;border-radius: 12px" lg>
                                <span class="flex justify-content-center">
                                    <span
                                            class="text-white font-medium text-base flex flex-row items-center justify-between">
                                        <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                             height="24" viewBox="0 0 40 41" fill="none">
                                            <path
                                                    d="M15.1127 19.3314C14.3546 18.5732 13.2174 18.5732 12.4592 19.3314C11.7011 20.0895 11.7011 21.2267 12.4592 21.9849L18.1453 27.671C18.5244 28.05 18.9035 28.2396 19.4721 28.2396C20.0407 28.2396 20.4198 28.05 20.7988 27.671L34.0664 12.508C34.635 11.5604 34.635 10.4231 33.6873 9.85453C32.9291 9.28592 31.7919 9.28592 31.2233 10.0441L19.4721 23.5012L15.1127 19.3314Z"
                                                    fill="white"/>
                                            <path
                                                    d="M36.5295 18.7622C35.3922 18.7622 34.6341 19.5203 34.6341 20.6575C34.6341 28.9971 27.8108 35.8204 19.4712 35.8204C11.1316 35.8204 4.3083 28.9971 4.3083 20.6575C4.3083 16.6772 5.82459 12.8865 8.66764 10.0435C11.5107 7.01088 15.3014 5.49459 19.4712 5.49459C20.6084 5.49459 21.9352 5.68413 23.0724 5.87366C24.0201 6.25274 25.1573 5.68413 25.5364 4.54691C25.9154 3.40969 25.1573 2.65154 24.2096 2.27247H24.0201C22.5038 1.89339 20.9875 1.70386 19.4712 1.70386C9.04671 1.70386 0.517578 10.233 0.517578 20.8471C0.517578 25.775 2.60248 30.703 6.01413 34.1146C9.61532 37.7158 14.3537 39.6112 19.2817 39.6112C29.7062 39.6112 38.2353 31.082 38.2353 20.6575C38.4248 19.5203 37.4771 18.7622 36.5295 18.7622Z"
                                                    fill="white"/>
                                        </svg>
                                        <span id="submitButton" class="mr-3">
                                            {{ auth()->user()->userAdmissionChallanImage != null ? 'Update' : 'Submit' }}
                                        </span>
                                    </span>
                                </span>
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>--}}

            @if(!$this->is_Stayed)
                {{--@if(!$sameCollege)--}}
                    <form wire:submit.prevent="submitAffidavit">
                        <div class="mb-10 bg-white pb-10 rounded-lg"
                            style="box-shadow: 0px 0px 10.666666984558105px 5.333333492279053px rgba(0, 0, 0, 0.03);">
                            <div>
                                <p class=" px-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">
                                    Upload Joining Report
                                </p>
                                <hr class="border-t-2 w-full border-[#DAE4EA]">
                            </div>
                            <div class="p-5 md:p-10 ">
                                <div>
                                    <div>
                                        <p
                                                class=" p-5  md:px-5 md:py-4 text-2xl font-medium text-black-600 tracking-[0.29px] font-sans">
                                            Note</p>
                                    </div>
                                    <ol>
                                        <li class="pt-3 text-lg font-normal flex flex-row">
                                            <span class="text-blue-900  pr-3">
                                                <x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800"/>
                                            </span>
                                            <span class="font-bold text-red-700 ml-2">
                                                If student wants to change his /her upgradation choice, he/she must contact the respective college within three days of display of last selection list.
                                            </span>
                                        </li>
                                        <li class="pt-3 text-lg font-normal flex flex-row">
                                            <span class="text-blue-900  pr-3">
                                                <x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800"/>
                                            </span>
                                            <span class="font-bold ml-2">
                                                I hereby confirm that I have duly submitted my written joining for the college. I acknowledge and understand that I am also required to physically report to the college within the prescribed deadline, failing which my admission shall stand canceled, and I shall forfeit any right to be considered for further admission or upgradation processes.
                                            </span>
                                        </li>
                                        <li class="pt-3 text-lg font-normal flex flex-row">
                                            <span class="text-blue-900  pr-3">
                                                <x-heroicon-s-light-bulb class="h-6 w-6 text-blue-800"/>
                                            </span>
                                            <span class="font-bold ml-2 flex flex-row">
                                                Please Download the Joining Report and fill it with the required information and upload it here.
                                                <a href="{{asset('joining_report_private.pdf')}}" target="_blank"><x-heroicon-s-document-download class="h-8 w-8"/></a>
                                            </span>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="p-5 md:p-10 ">
                                {{--@if(!empty($merit_list_college) || true)--}}
                                    {{--@if (!empty($studentPath) && !empty($studentPath->student_affidavit_path) || true)
                                        <div class="mt-5">
                                            <p class="text-xl text-[#15803D] font-bold text-center">
                                                Your Joining Report is submitted successfully
                                            </p>
                                        </div>
                                    @else--}}
                                        {{--<div class="mt-0">
                                            <p class="text-lg font-normal text-red-500 text-center">
                                                Please upload the pdf of your joining report here to
                                                <br>
                                                complete the application process
                                            </p>
                                        </div>--}}
                                            @if(empty($filePath))
                                                <div class="mt-5">
                                                    <p class="text-lg font-normal text-red-500 text-center">
                                                        Please upload the pdf Joining Report here to
                                                        <br>
                                                        complete the joining processs
                                                    </p>
                                                </div>
                                            @else
                                                <div class="mt-5">
                                                    <p class="text-xl text-[#15803D] font-bold text-center">
                                                        Your Joining Report is submitted successfully
                                                    </p>
                                                </div>
                                            @endif

                                            @if($this->isOpenMerit && $isOversease && auth()->user()->selection_seat_id == 0)
                                                <div class="grid center ml-12 grid-cols-3 md:grid-cols-3 gap-7">
                                                    <div class="mt-5">
                                                        <label
                                                            class="text-black text-lg font-medium font-sans ">
                                                            Choose seat you want to joining
                                                            <span class="text-red-600">*</span>
                                                        </label>
                                                        <x-select
                                                                class="mt-3"
                                                            wire:model.defer="seatCategory"
                                                            placeholder="Seat Category" 
                                                            :options="['Open Merit','Overseas']"
                                                            style="padding: 8px 8px;" rightIcon="chevron-down"
                                                            style="box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.12);" />

                                                    </div>
                                                </div>
                                            @endif
                                            
                                        <div class="mt-8 flex justify-center">
                                            <div class="flex flex-col w-11/12 justify-center items-center">
                                                <div
                                                        class="w-full p-4 bg-[#F0F4F680] bg-whtie m-auto rounded-lg border-2 border-dashed border-[#6B8097B2]">
                                                    <div>
                                                        <svg class="mx-auto mb-2 mt-2" xmlns="http://www.w3.org/2000/svg"
                                                            width="82" height="78" viewBox="0 0 82 78" fill="none">
                                                            <ellipse cx="41.2584" cy="39.1062" rx="40.3463" ry="38.824"
                                                                    fill="#148DCB"/>
                                                            <path
                                                                    d="M55.6779 55.7019H45.2904V45.6016H48.7233C49.5938 45.6016 50.1083 44.6497 49.5938 43.9643L42.9162 35.073C42.4908 34.5018 41.6103 34.5018 41.1849 35.073L34.5072 43.9643C33.9928 44.6497 34.4973 45.6016 35.3778 45.6016H38.8106V55.7019H27.1766C21.9829 55.4258 17.8477 50.7517 17.8477 45.6873C17.8477 42.1936 19.8163 39.1474 22.7347 37.5005C22.4676 36.8056 22.3291 36.063 22.3291 35.2824C22.3291 31.7126 25.3267 28.8282 29.0365 28.8282C29.8378 28.8282 30.6094 28.9614 31.3316 29.2185C33.4784 24.8395 38.1082 21.8027 43.4899 21.8027C50.4545 21.8123 56.1924 26.9433 56.8453 33.4832C62.1973 34.3686 66.2633 39.1379 66.2633 44.5355C66.2633 50.3043 61.5939 55.3021 55.6779 55.7019Z"
                                                                    fill="white"/>
                                                        </svg>
                                                        {{--<div class="mx-auto w-4/5">
                                                            <x-filepond.filepond size="1024*1024" allowFileImagePreview name="studentAffidavit"
                                                                                required id="studentAffidavit_id"
                                                                                wire:model="studentAffidavit"
                                                                                acceptedFileTypes="['application/pdf']"/>
                                                        </div>--}}
                                                        <div class="flex justify-center items-center">
                                                            <x-dynamic-file-upload-pdf
                                                                    class="w-full"
                                                                    required
                                                                    inputHeading="Only Pdf file Upload"
                                                                    accept=".pdf"
                                                                    label="Student Joining Report"
                                                                    name="studentAffidavit"
                                                                    :filePath="$filePath"
                                                                    :fileName="$fileName"
                                                            />
                                                        </div>
                                                        <div class="mt-2">
                                                            <p class="font-medium text-xs text-center text-[#00000066]">
                                                                PDF, file size no more than 1MB
                                                            </p>
                                                        </div>
                                                        @error('challan')
                                                        <div class="text-center error text-red-600 mt-2">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-7 ms-4 flex items-center gap-4">
                                            <div class="mt-7 md:mt-0">
                                                <div class="text-3xl text-[#333333] font-semibold tracking-[0.29px] font-sans mb-5">

                                                </div>
                                                <div class="flex items-center space-x-4">
                                                    <div id="radio-container" class="{{ $isStayOrUpgraded == '1' ? 'mb-2 md:mb-0 transition-colors duration-0 md:mr-2 border border-[#5345ff] rounded-md flex items-center py-2 px-5 bg-[#5345ff]' : 'mb-2 md:mb-0 md:mr-2 border transition-colors duration-0 border-[#5345ff] rounded-md py-2 px-5 flex items-center  bg-[#EBFFFF]' }}">
                                                        <div wire:ignore>
                                                            <x-radio id="yes" wire:model="isStayOrUpgraded" value="1"/>
                                                        </div>
                                                        <span class="{{ $isStayOrUpgraded == '1' ? 'ml-2 text-white text-base font-medium' : 'ml-2 text-[#5345ff] text-base font-medium' }}">
                                                        I would like to Stay
                                                        </span>
                                                    </div>

                                                    <div id="radio-container"
                                                            class="{{ $isStayOrUpgraded == '0' ? 'mb-2 md:mb-0 transition-colors duration-0 md:mr-2 border border-[#5345ff] rounded-md flex items-center py-2 px-5 bg-[#5345ff]' : 'mb-2 md:mb-0 md:mr-2 border transition-colors duration-0 border-[#5345ff] rounded-md py-2 px-5 flex items-center  bg-[#EBFFFF]' }}">
                                                        <div wire:ignore>
                                                            <x-radio id="no" wire:model="isStayOrUpgraded" value="0"/>
                                                        </div>
                                                        <span class="{{ $isStayOrUpgraded == '0' ? 'ml-2 text-white text-base font-medium' : 'ml-2 text-[#5345ff] text-base font-medium' }}">
                                                        I would like to be upgraded
                                                        </span>
                                                    </div>
                                                    <span id="radio-error" class="text-red-500 text-sm hidden">Please select an option before proceeding.</span>
                                                </div>
                                            </div>


                                        </div>


                                        <div class="mt-10 flex flex-row justify-center" id="submitButton">
                                            <x-button type="submit" blue style="width: 200px;border-radius: 12px" lg>
                                            <span class="flex justify-content-center">
                                                <span
                                                        class="text-white font-medium text-base flex flex-row items-center justify-between">
                                                    <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 40 41" fill="none">
                                                        <path
                                                                d="M15.1127 19.3314C14.3546 18.5732 13.2174 18.5732 12.4592 19.3314C11.7011 20.0895 11.7011 21.2267 12.4592 21.9849L18.1453 27.671C18.5244 28.05 18.9035 28.2396 19.4721 28.2396C20.0407 28.2396 20.4198 28.05 20.7988 27.671L34.0664 12.508C34.635 11.5604 34.635 10.4231 33.6873 9.85453C32.9291 9.28592 31.7919 9.28592 31.2233 10.0441L19.4721 23.5012L15.1127 19.3314Z"
                                                                fill="white"/>
                                                        <path
                                                                d="M36.5295 18.7622C35.3922 18.7622 34.6341 19.5203 34.6341 20.6575C34.6341 28.9971 27.8108 35.8204 19.4712 35.8204C11.1316 35.8204 4.3083 28.9971 4.3083 20.6575C4.3083 16.6772 5.82459 12.8865 8.66764 10.0435C11.5107 7.01088 15.3014 5.49459 19.4712 5.49459C20.6084 5.49459 21.9352 5.68413 23.0724 5.87366C24.0201 6.25274 25.1573 5.68413 25.5364 4.54691C25.9154 3.40969 25.1573 2.65154 24.2096 2.27247H24.0201C22.5038 1.89339 20.9875 1.70386 19.4712 1.70386C9.04671 1.70386 0.517578 10.233 0.517578 20.8471C0.517578 25.775 2.60248 30.703 6.01413 34.1146C9.61532 37.7158 14.3537 39.6112 19.2817 39.6112C29.7062 39.6112 38.2353 31.082 38.2353 20.6575C38.4248 19.5203 37.4771 18.7622 36.5295 18.7622Z"
                                                                fill="white"/>
                                                    </svg>
                                                    <span id="submitButton" class="mr-3">
                                                        Submit
                                                    </span>
                                                </span>
                                            </span>
                                            </x-button>
                                        </div>
                                    {{--@endif--}}
                                {{--@endif--}}
                            </div>
                        </div>
                    </form>
                {{--@endif--}}
            @endif
        @endif
    {{--@endif--}}
</div>
<script>
    Livewire.on('challanUploaded', () => {
        window.location.reload();
    });

    /* I required the isStayOrUpgraded because I upload last selection list
              and I want user to select the stay option after uploading the affidavit */
    document.getElementById('submitButton').addEventListener('click', function(event) {
        let radioChecked = document.querySelector('input[name="isStayOrUpgraded"]:checked');
        let errorMessage = document.getElementById('radio-error');

        if (!radioChecked) {
            event.preventDefault(); // Stop form submission
            errorMessage.classList.remove('hidden'); // Show error message
        } else {
            errorMessage.classList.add('hidden'); // Hide error message if valid
        }
    });
</script>
