<div x-data="{
        hasPhoto: @json($filePath ? true : false),
        showSaveMessage: false,
        showUploadForm: false,
        errorMessage: '',
        validateFileSize(event) {
                const file = event.target.files[0];
                const allowedFileType = 'application/pdf';

                if (file) {
                    if (file.size > 1024 * 1024) { // File size validation (1MB limit)
                        this.errorMessage = 'The uploaded file must be 1 MB or smaller.';
                        event.target.value = ''; // Clear the file input
                    } else if (event.target.accept.includes('.pdf')) {
                        if (file.type !== allowedFileType) { // PDF format validation
                            this.errorMessage = 'Only PDF files are allowed.';
                            event.target.value = '';
                        } else {
                            this.errorMessage = '';
                            $wire.emit('clearValidationError', '{{ $name }}');
                        }
                    } else {
                        this.errorMessage = '';
                        $wire.emit('clearValidationError', '{{ $name }}');
                    }
                }
            }
    }">

    <!-- If file is already uploaded -->
    <div x-show="hasPhoto && !showUploadForm" x-cloak class="flex flex-col gap-1">
        <div class="flex flex-row items-center gap-2">
            <span>Already Uploaded</span>
            <x-tick-icon/>
        </div>
        <div>
            <span class="font-normal">{{ $label }}</span>
            <span class="text-blue-400 cursor-pointer underline hover:no-underline"
                  @click="showUploadForm = true">Edit</span>
            <span>or</span>
            <span>
                <a class="text-blue-400 underline hover:no-underline" href="{{ url('storage/' . $filePath) }}"
                   target="_blank">view</a>
            </span>
        </div>
    </div>

    <!-- If no file is uploaded or the update form is triggered -->
    <div x-show="!hasPhoto || showUploadForm" x-cloak class="max-w-sm">
        <label for="{{ $name }}" class="text-xs font-medium text-gray-500">{{ $label }}</label>
        <br>
        <label for="{{ $name }}" class="text-xs font-medium text-gray-500">{{$inputHeading}}</label>
        <div class="relative z-0 mt-0.5 flex w-full -space-x-px">
            <input id="{{ $name }}"
                   wire:model="{{ $name }}"
                   value="{{ $fileName }}"
                   accept=".pdf"
                   type="file"
                   @change="validateFileSize($event)"
                   class="block w-full cursor-pointer appearance-none rounded-l-md border border-gray-200 bg-white px-3 py-2 text-sm transition focus:z-10 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 disabled:cursor-not-allowed disabled:bg-gray-200 disabled:opacity-75"
            >
            {{--<button type="button"
                    wire:click="{{ $name }}"
                    @click="showSaveMessage = true; setTimeout(() => showSaveMessage = false, 3000)"
                    class="inline-flex w-auto cursor-pointer select-none appearance-none items-center justify-center space-x-1 rounded-r border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 transition hover:border-gray-300 hover:bg-gray-100 focus:z-10 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                Save
            </button>--}}
        </div>
    </div>

    <!-- Validation error message -->
    <div style="margin-left: -30%" x-show="errorMessage" x-cloak
         class="mt-3 text-red-600 text-sm font-medium text-center justify-center items-center">
        The uploaded file must be 1 MB or smaller and only PDF files are accepted.
    </div>

    <!-- Save success message -->
    <div x-show="showSaveMessage" x-cloak
         class="mt-3 text-green-600 text-sm font-medium">
        File saved successfully!
    </div>

    <!-- Validation error message -->
    @error($name)
    <div class="text-center error text-sm text-red-600 mt-2">
        The uploaded file should be less than 1MB and in PDF format.
    </div>
    @enderror
</div>
