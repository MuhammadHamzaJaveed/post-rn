<div>
    <p class="font-bold">Uploaded Challan Form Image</p>
    <x-filepond.filepond id="schoolLeaving" wire:model="data.uploadImage"
                         file="{{ url($this->cnic ?? '') }}" allowFileImagePreview acceptedFileTypes="['image/*']"  maxFileSize=" 1MB"/>

</div>