@props([
    'flashType' => 'primary'
])

<div x-data="{ showFlash: true }"
     x-show="showFlash"
     x-transition.duration.1000ms
     x-cloak
     :class="showFlash ? 'animate-fade-in-down duration-1000' : 'animate-fade-out-down duration-1000' "
    {{ $attributes->merge(['class' => "flash-notification bg-$flashType-500"]) }}
>
    <div class="flex items-center">
        <div class="ml-3">
            <p class="text-sm font-medium text-white">
               {{ $slot }}
            </p>
        </div>

        <div class="ml-auto pl-3">
            <div
                class="-mx-1.5 -my-1.5 block">
                <button
                    @click="showFlash = false"
                    type="button"
                        class="inline-flex p-1.5 text-white">

                    <span class="sr-only">
                        Dismiss
                    </span>

                    <x-heroicon-o-x class="h5 w-5"></x-heroicon-o-x>
                </button>
            </div>
        </div>
    </div>
</div>
