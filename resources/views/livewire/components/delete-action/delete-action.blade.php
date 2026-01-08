<div class="p-4 flex flex-col">
    <div class="flex justify-center mb-3">
        <h4 class="text-lg text-secondary-900 font-semibold">
            Delete User
        </h4>
    </div>

    <div class="flex justify-center mb-5">
        <p class="text-sm text-secondary-500">
            Are you sure about deleting this user ?
        </p>
    </div>

    <div class="flex flex-row text-center items-center justify-center">
        <div class="border-blue-400 border-2 rounded-2xl px-4 mr-2">
            <button
                    class="text-sm hover:text-blue-400 p-2"
                    type="button"
                    wire:click="deleteItem"
            >
                yes
            </button>
        </div>

        <div class="border-blue-400 border-2 rounded-2xl px-4">
            <button
                    class="text-sm hover:text-blue-400 p-2"
                    type="button"
                    wire:click="$emit('closeModal')"
            >
               No
            </button>
        </div>
    </div>
</div>
