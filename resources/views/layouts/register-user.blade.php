<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UHS</title>

    {{--<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>--}}
    <link href="{{asset('css/googleapis.css')}}" rel="stylesheet"/>

    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"/>--}}

    <link rel="stylesheet" href="{{asset('css/charts.min.css')}}"/>

    <script
            {{--src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"--}}
            src="{{asset('js/chart.min.js')}}"
            defer
    ></script>

    {{--<script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>--}}

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    <link rel="stylesheet" href="{{ url(''. mix('css/app.css', '')) }}">


    {{--<link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
    <wireui:scripts/>
    @livewireStyles
</head>
<body>
    <div class="font-sans text-gray-900 antialiased">
        @yield('content')
    </div>
@stack('modals')


@livewire('livewire-ui-modal')

<!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}

    <script src="{{ url(''. mix('js/app.js')) }}" defer></script>

    {{--<script src="{{ asset('js/app.js')}}" defer></script>--}}

<!----------------Added scripts goes here---------------->
@stack('scripts')
    @livewireScripts
<!----------------./Added scripts goes here---------------->
</body>
</html>
