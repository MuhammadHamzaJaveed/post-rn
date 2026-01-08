<div class="p-4 max-h-screen overflow-y-auto no-scrollbar">
    <div class="flex justify-center mb-3">
        <h4 class="text-lg text-secondary-900 font-semibold">
            Update User
        </h4>
    </div>

    <form wire:submit.prevent="submit">

        <x-select
                label="User Role"
                class="mt-3 mb-3"
                placeholder="Select Role"
                wire:model.defer="role_name"
                label="Role"
        >
            <x-select.option label="Super Admin" value="Admin"/>
            <x-select.option label="Manager" value="Manager"/>
            <x-select.option label="Guest" value="Guest"/>
        </x-select>

        <div class="rounded-md text-white mt-6">
            <button
               class=" bg-purple-500 text-sm p-2 w-full mb-2 rounded flex flex-row items-center gap-2 justify-center"
               type="submit"
            >
                <span
                  wire:target="submit"
                  wire:loading.remove
                  class="flex flex-row items-center gap-2 justify-center"
                >
                    Submit
                    <x-heroicon-o-arrow-circle-right class="w-5 h-5"/>
                </span>

                <span wire:loading wire:target="submit">
                    <x-loader />
                </span>
            </button>

            <button
                    class="bg-purple-500 text-sm p-2 w-full rounded flex flex-row items-center gap-2 justify-center"
                    type="button"
                    wire:click="$emit('closeModal')"
            >
                Close <x-heroicon-o-x-circle class="w-5 h-5"/>
            </button>
        </div>
    </form>
</div>
