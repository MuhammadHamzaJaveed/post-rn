<div>
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                 wire:click="closeModal"></div>

            <!-- Modal Container -->
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal Content - Aapka exact design -->
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <div class="rounded-xl p-5 pt-12 pb-12 md:p-12">
                        <div class="w-28 h-28 rounded-full mx-auto mb-4 bg-green-200 bg-opacity-70 flex items-center justify-center">
                            <img src="{{ asset('images/tick.svg') }}" alt="Image" class="rounded-full max-w-full max-h-full">
                        </div>

                        <h2 class="text-xl font-semibold text-center text-[#07478C]">
                            Your application will remain incomplete until the fee has been deposited
                        </h2>

                        <p class="mt-2 text-[#6B8097] font-sans text-center">Now complete the given instructions</p>

                        <p class="mt-6 text-[#6B8097] font-sans">1. Review and download your information</p>
                        <p class="mt-2 text-[#6B8097] font-sans">2. A challan form is attached at your Dashboard.</p>
                        <p class="mt-2 text-[#6B8097] font-sans">3. Pay the challan fee at the bank mentioned on the challan form.</p>
                        <p class="mt-2 text-[#6B8097] font-sans">4. Upload the picture of this paid challan on this portal</p>

                        <div class="flex justify-center space-x-2 mt-4">
                            <a href="{{ route('uhs-form-application-status') }}"
                               class="bg-[#07478C] font-sans text-white font-bold py-2 px-2 md:px-4 rounded-lg mt-4">
                                View Application
                            </a>

                            <a href="{{ route('uhs-form-dashboard') }}"
                               class="bg-white font-sans border border-solid border-[#9BABB7] rounded-lg cursor-pointer text-[#687076] font-bold py-2 px-2 md:px-4 mt-4">
                                Go to Dashboard and Generate Challan
                            </a>
                        </div>

                        <!-- Close Button -->
                        {{--<div class="flex justify-center mt-6">
                            <button wire:click="closeModal"
                                    class="text-[#07478C] font-sans font-bold py-2 px-4 rounded-lg border border-[#07478C] hover:bg-blue-50">
                                Close
                            </button>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>