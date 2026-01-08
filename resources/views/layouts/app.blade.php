<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UHS APP</title>

    {{--<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>--}}
    <link href="{{asset('css/googleapis.css')}}" rel="stylesheet"/>
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"/>--}}
    <link rel="stylesheet" href="{{asset('css/charts.min.css')}}"/>

    <script
            {{--src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"--}}
            src="{{asset('js/chart.min.js')}}"
            defer
    ></script>

    {{--<script src="https://cdn.tailwindcss.com"></script>--}}

    <script src="{{asset('js/tailwindcss.js')}}"></script>

    {{--<script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>--}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <wireui:scripts/>
    @livewireStyles
    @livewireScripts

</head>
<body>
<div
        x-data="{ isSideMenuOpen: false,
         toggleSideMenuOpen() {
             if (this.isSideMenuOpen) {
                return this.closeSideMenuOpen()
             }
             this.isSideMenuOpen = true
         },
         closeSideMenuOpen() {
             if (! this.isSideMenuOpen) return
             this.isSideMenuOpen = false
         }
     }"
>
    <div
        class="flex h-screen"
        :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
        <!-- Desktop sidebar -->
       
            <x-desktop-sidebar />

            <!-- Mobile sidebar -->
            <x-mobile-sidebar />
            <!-- Backdrop -->
        {{-- @endrole --}}
            <div class="bg-[#25282D] flex flex-col flex-1 w-full">
                <div class="flex flex-col flex-1 w-full">
                    <x-navbar/>
    
                    <main class="h-full bg-gray-50 overflow-y-auto">
                        <div class="flex items-center justify-center">
                            <x-notifications.sessions.flash-container class="w-full"/>
                        </div>
    
                        <div class="container px-6 mx-auto grid">
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>
    </div>
</div>
@stack('modals')


@livewire('livewire-ui-modal')

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

<!----------------Added scripts goes here---------------->
@stack('scripts')
<!----------------./Added scripts goes here---------------->
</body>
</html>
