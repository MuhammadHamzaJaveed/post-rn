@php
    $universityMbbsPreferences = $getRecord()->mbbsCollegePreferences->pluck('college_pref')->toArray();
    $preferences = json_decode($universityMbbsPreferences[0], true);

    $universityBdsPreferences = $getRecord()->bdsCollegePreferences->pluck('college_pref')->toArray();
    $preferencesBDS = json_decode($universityBdsPreferences[0], true);

@endphp

<div class="mt-7 mb-7 pb-10 bg-white rounded-lg">
    <div>
        <p class="px-5 md:px-10 py-4 text-2xl font-medium text-[#333333] tracking-[0.29px] font-sans">College Preferences</p>
        <hr class="border-t-2 w-full border-[#DAE4EA]">
    </div>

    <div class="p-10 grid grid-cols-2 gap-5 mt-4">
        <div>
            <h4 class="font-bold text-xl">Selected University MBBS Preferences:</h4>
            <ul class="mt-4">
                @foreach ($preferences as $preference)
                    <li>{{ $preference['name'] }}</li>
                @endforeach
            </ul>
        </div>

        <div style="border-left: 4px solid #DAE4EA; padding-left: 80px;">
            <h4 class="font-bold text-xl">Selected University BDS Preferences:</h4>
            <ul class="mt-4">
                @foreach ($preferencesBDS as $preference)
                    <li>{{ $preference['name'] }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


