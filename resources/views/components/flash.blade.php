<div x-data="{ showFlash: true}"
     x-show="showFlash"
     x-transition.duration.1000ms
     x-cloak
        {{ $attributes->merge(['class' => "flex justify-center items-center mt-6 p-4 py-4 px-2 bg-primary-400 border-none w-80 rounded-full"]) }}
>
    <div class="flex items-center justify-between">
        <div class="ml-3">
            <p class="text-sm font-medium text-white">
                {{ $slot }}
            </p>
        </div>

        <div class="ml-auto px-3 ">
            <div class="-mx-1.5 -my-1.5 block">
                <button
                        @click="showFlash = false"
                        type="button"
                        class="inline-flex p-1.5 text-white">

                    <x-heroicon-o-x class="h5 w-5"></x-heroicon-o-x>
                </button>
            </div>
        </div>
    </div>
</div>
