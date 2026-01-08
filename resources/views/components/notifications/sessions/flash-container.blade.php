@props([
    'isInternal' => 'true',
])

@php
    $customClass = $isInternal === 'true' ? 'top-2' : 'top-24';
@endphp

<div class="w-full">
    @if (session('primary'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Livewire.emit(
                    'openModal',
                    'components.flash-message.flash-message',
                        {!! json_encode(["message" => session()->pull('primary'), 'status' => 'success']) !!}
                );
            });
        </script>
    @endif

    @if (session('info'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Livewire.emit(
                        'openModal',
                        'components.flash-message.flash-message',
                            {!! json_encode(["message" => session()->pull('info'), 'status' => 'success']) !!}
                    );
                });
            </script>
    @endif

    @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Livewire.emit(
                        'openModal',
                        'components.flash-message.flash-message',
                            {!! json_encode(["message" => session()->pull('success'), 'status' => 'success']) !!}
                    );
                });
            </script>
    @endif

    @if (session('danger'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Livewire.emit(
                        'openModal',
                        'components.flash-message.flash-message',
                            {!! json_encode(["message" => session()->pull('danger'), 'status' => 'danger']) !!}
                    );
                });
            </script>
    @endif
</div>
