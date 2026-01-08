<!-- Modal -->
<div id="modal" class="rounded-xl p-5 pt-12 pb-12 md:p-12">
    <div class="w-28 h-28 rounded-full mx-auto mb-4 bg-green-200 bg-opacity-70 flex items-center justify-center">
        <img src="{{ asset('images/tick.svg') }}" alt="Image" class="rounded-full max-w-full max-h-full">
        <!-- Add your image URL and adjust the image size as needed -->
    </div>
    <h2 class="text-xl font-semibold text-center text-[#07478C]">Your application will remain incomplete until the fee has been deposited</h2>
    <p class="mt-2 text-[#6B8097] font-sans text-center">Now complete the given instructions</p>
    <p class="mt-6 text-[#6B8097] font-sans">1. Review and download your information</p>
    <p class="mt-2 text-[#6B8097] font-sans">2. A challan form is attached at your Dashboard.
    <p class="mt-2 text-[#6B8097] font-sans">3. Pay the challan fee at the bank mentioned on the challan form.</p>
    <p class="mt-2 text-[#6B8097] font-sans">4. Upload the picture of this paid challan on this portal</p>

    <div class="flex justify-center space-x-2 mt-4">
        <a href="{{ route('uhs-form-application-status') }}" class="bg-[#07478C] font-sans text-white font-bold py-2 px-2 md:px-4 rounded-lg mt-4">
            View Application
        </a>

        <a href="{{ route('uhs-form-dashboard') }}"
           class="bg-white font-sans border border-solid border-[#9BABB7] rounded-lg cursor-pointer text-[#687076] font-bold py-2 px-2 md:px-4 mt-4"
        >
            Go to Dashboard
        </a>
    </div>
</div>
