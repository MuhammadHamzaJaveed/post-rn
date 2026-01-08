<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{--<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>--}}

    <link href="{{asset('css/googleapis.css')}}" rel="stylesheet"/>

    {{--<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />--}}

    <link href="{{asset('css/filepond.css')}}" rel="stylesheet" />

    <link
            {{--href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"--}}
            href="{{asset('css/filepond-image-preview.css')}}"
            rel="stylesheet"
    />
    {{--<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>--}}

    <script src="{{asset('js/filepond-image-preview.js')}}"></script>
    <script src="{{asset('js/filepond-file-type-validation.js')}}"></script>
    <script src="{{asset('js/filepond-file-validation-size.js')}}"></script>
    <script src="{{asset('js/filepond.js')}}"></script>


    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"/>--}}

    <link rel="stylesheet" href="{{asset('css/charts.min.css')}}"/>

    {{--<script src="https://kit.fontawesome.com/536e6c8961.js" crossorigin="anonymous"></script>--}}

    <script src="{{asset('js/font-awesome.js')}}" crossorigin="anonymous"></script>

    {{--<script src="https://cdn.tailwindcss.com"></script>--}}

    <script src="{{asset('js/tailwindcss.js')}}"></script>

    <title>Admission Form</title>

    {{--  <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    <link rel="stylesheet" href="{{ url(''. mix('css/app.css', '')) }}">

    {{--<link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}

    <wireui:scripts/>
    @livewireStyles
    @livewireScripts
</head>
<body class="bg-[#F6F9FC]">
    <livewire:top-nav />

    <div class="px-[1rem] lg:px-[3.69rem] md:min-h-screen xl:min-h-screen">
        @yield('content')
    </div>

    <div>
       <x-footer-uhs/>
       
    </div>
    <livewire:challan-status-modal />
    <livewire:application-incomplete-modal />
    @stack('modals')


    @livewire('livewire-ui-modal')

    <!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}

    <script src="{{ url(''. mix('js/app.js')) }}" defer></script>
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginFileValidateSize);
        });
    </script>


    <!----------------Added scripts goes here---------------->
    @stack('scripts')
</body>
</html>
