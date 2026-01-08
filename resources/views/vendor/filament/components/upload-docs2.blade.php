<div class="mt-5">
    <p class="font-bold">User Profile Image</p>

    <x-filepond.filepond id="schoolLeaving" wire:model="data.uploadImage2"
                         file="{{ url($this->image ?? '') }}" allowFileImagePreview acceptedFileTypes="['image/*']"  maxFileSize="1MB"/>

</div>