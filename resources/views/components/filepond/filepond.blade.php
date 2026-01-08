@props([
'id' => rand(),
'name',
'helpText' => '',
'file' => null,
])

<div>
    <div
            wire:ignore
            x-data="{ filePondInstance: null }"
            x-init="

        $nextTick(() => {
            const pond = FilePond.create($refs.{{ $attributes->get('ref') ?? 'input' }});
            this.filePondInstance = pond;

            pond.setOptions({
                credits: false,
                allowMultiple: {{ $attributes->has('multiple') ? 'true' : 'false' }},
                allowFileTypeValidation: true,
                allowImagePreview: {{ $attributes->has('allowFileImagePreview') ? 'true' : 'false' }},
                allowImageCrop: {{ $attributes->has('allowImageCrop') ? 'true' : 'false' }},
                imagePreviewMaxHeight: {{ $attributes->has('imagePreviewMaxHeight') ? $attributes->get('imagePreviewMaxHeight') : '256' }},
                allowFileSizeValidation: {{ $attributes->has('size') ? 'true' : 'false' }},
                maxFileSize: {!! $attributes->get('size') ?? 'null' !!},
                required : {{ $attributes->has('required') ? 'true' : 'false' }},
                acceptedFileTypes: {!! $attributes->get('acceptedFileTypes') ?? 'null' !!},
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {

                        @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                    },
                },
            });

            if ('{{$file}}') {
                pond.addFile('{{$file}}');
            }
        });
        "
    >
        <input
                style="display: none"
                x-show="filePondInstance"
                type="file"
                x-ref="{{ $attributes->get('ref') ?? 'input' }}"
        >
    </div>

    @if($helpText)
        <small id="{{ $id }}_help" class="text-xs text-gray-400">{{ $helpText }}</small>
    @endif
</div>
