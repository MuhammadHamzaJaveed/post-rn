<div class="p-4 max-h-screen overflow-y-auto no-scrollbar">
    <div class="flex justify-center mb-3">
        <h4 class="text-lg text-secondary-900 font-semibold">
            {{ $heading }}
        </h4>
    </div>

    <form wire:submit.prevent="submit">

        <x-input
                class="mt-2 font-['Inter'] text-lg font-semibold border-none"
                style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10)"
                type="text"
                wire:model.debounce.500ms="name"
                label="Name"
        />

        <div class="rounded-md text-white mt-6">
            <button
                    class="bg-purple-500 text-sm p-2 w-full mb-2 rounded flex flex-row items-center gap-2 justify-center"
                    type="submit"
            >
                <span wire:target="submit" wire:loading.remove class="flex flex-row items-center gap-2 justify-center">
                    Submit
                    <x-heroicon-o-arrow-circle-right class="w-5 h-5"/>
                </span>
                <span wire:loading wire:target="submit">
                    <x-loader />
                </span>
            </button>
        </div>
    </form>
</div>
