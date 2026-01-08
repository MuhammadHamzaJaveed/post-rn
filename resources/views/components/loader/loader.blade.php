@props([
    'isSmall' => false
])

<div
    {{ $attributes->merge(['class' => 'flex flex-col py-4 justify-center rounded-3xl']) }}
    {{ $attributes }}
>
    <img
        @class([
            'h-10 w-10' => $isSmall
        ])
        src="{{ asset('images/loader.svg') }}" alt="loading">
</div>
