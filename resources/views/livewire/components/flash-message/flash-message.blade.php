<div class="p-4 flex flex-col">
    <div class="flex justify-center mb-3">
        <h4 class="text-lg text-secondary-900 font-semibold">
            {{ $status }}
        </h4>
    </div>

    <div class="flex items-center justify-center">
        <div class="w-12 h-12 border-2 border-green-500 rounded-full flex items-center justify-center bg-white">
            <x-heroicon-o-check class="w-6 h-6 text-green-500"/>
        </div>
    </div>

    <div class="flex justify-center mb-5 mt-5">
        <p class="text-sm text-secondary-500">
            {{ $message }}
        </p>
    </div>
</div>
