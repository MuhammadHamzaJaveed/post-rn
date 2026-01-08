@php
    $programSelected = $getRecord()->program?->name;
    $prioritySelected = $getRecord()->program_priority;

@endphp

<div class="mt-7 mb-7 pb-10 bg-white rounded-lg">
    <div class="p-10 grid grid-cols-2 gap-5 mt-4">
        <div>
            <h2 class="flex items-center justify-between space-x-2 rtl:space-x-reverse">Selected Program</h2>
            <input class="filament-forms-input block w-full rounded-lg shadow-sm outline-none transition duration-75 focus:ring-1 focus:ring-inset disabled:opacity-70 border-gray-300 focus:border-primary-500 focus:ring-primary-500" disabled type="text" value="{{$programSelected}}"/>
        </div>

        <div>
            <h2 class="flex items-center justify-between space-x-2 rtl:space-x-reverse">Selected Program Priority</h2>
            <input class="filament-forms-input block w-full rounded-lg shadow-sm outline-none transition duration-75 focus:ring-1 focus:ring-inset disabled:opacity-70 border-gray-300 focus:border-primary-500 focus:ring-primary-500" disabled type="text" value="{{$prioritySelected}}"/>
        </div>
    </div>
</div>