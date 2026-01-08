<div>
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                 wire:click="closeModal"></div>

            <!-- Modal -->
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                    <!-- Modal Content -->
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <!-- Icon -->
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full
                            @if($modalType === 'success') bg-green-100 text-green-600
                            @elseif($modalType === 'warning') bg-yellow-100 text-yellow-600
                            @elseif($modalType === 'error') bg-red-100 text-red-600
                            @else bg-blue-100 text-blue-600 @endif
                            sm:mx-0 sm:h-10 sm:w-10">

                                @if($modalType === 'success')
                                    <x-heroicon-s-check-circle class="w-6 h-6" />
                                @elseif($modalType === 'warning')
                                    <span class="w-6 h-6">
                                        <x-heroicon-o-exclamation class="w-6 h-6" />
                                    </span>

                                @elseif($modalType === 'error')
                                    <x-heroicon-s-x-circle class="w-6 h-6" />
                                @else
                                    <x-heroicon-s-information-circle class="w-6 h-6" />
                                @endif
                            </div>

                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                    {{ $modalTitle }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        {{ $modalMessage }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button wire:click="closeModal" type="button"
                                class="inline-flex w-full justify-center rounded-md border border-transparent
                                   @if($modalType === 'success') bg-green-600 hover:bg-green-700
                                   @elseif($modalType === 'warning') bg-yellow-600 hover:bg-yellow-700
                                   @elseif($modalType === 'error') bg-red-600 hover:bg-red-700
                                   @else bg-blue-600 hover:bg-blue-700 @endif
                                   px-4 py-2 text-base font-medium text-white shadow-sm focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>