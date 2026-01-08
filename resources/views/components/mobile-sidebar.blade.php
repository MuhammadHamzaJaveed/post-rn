<div>
    <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end sm:items-center sm:justify-center">
    </div>

    <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-20 overflow-y-auto bg-[#25282D] md:hidden"
        x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenuOpen"
        @keydown.escape="closeSideMenuOpen">
        <div class="py-4 text-white">
            <div class="flex flex-row items-center pl-4">
                <img src="{{ asset('images/img-logo.png') }}" alt="Rkees-logo"
                    class="items-start rounded-full w-[45.89px] h-[45.89px] object-fit">
                <a class="ml-3 text-lg font-bold text-white" href="#">
                    CPAT Cloud
                </a>
            </div>
            @role(['Admin', 'Manager'])
                <ul class="mt-6">
                    <li class="relative px-6 py-3">

                        @if (request()->routeIs('dashboard'))
                            <span class="absolute left-0 bg-white w-1 h-[25px] " aria-hidden="true"></span>
                        @endif
                        <a @class([
                            'inline-flex items-center w-full text-[18px] font-normal transition-colors duration-150 hover:text-[#00AEC6]',
                            'text-white' => request()->routeIs('dashboard'),
                        ]) href="{{ route('dashboard') }}">
                            <x-heroicon-s-home class="w-5 h-5" />
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                </ul>
            @endrole
            @role('Admin')
                <ul>
                    <li class="relative px-6 py-3">
                        @if (request()->routeIs('user-details'))
                            <span class="absolute left-0 bg-white w-1 h-[25px] " aria-hidden="true"></span>
                        @endif

                        <a @class([
                            'inline-flex items-center w-full text-[18px] font-normal transition-colors duration-150 hover:text-[#00AEC6]',
                            'text-white' => request()->routeIs('user-details'),
                        ]) href="{{ route('user-details') }}">
                            <x-heroicon-s-user class="w-5 h-5" />
                            <span class="ml-3">User</span>
                        </a>
                    </li>
                </ul>

                <ul>
                    <li class="relative px-6 py-3">
                        @if (request()->routeIs('department'))
                            <span class="absolute left-0  bg-white w-1 h-[25px] " aria-hidden="true"></span>
                        @endif
                        <a @class([
                            'inline-flex items-center w-full text-[18px] font-normal transition-colors duration-150 hover:text-[#00AEC6] ',
                            'text-white' => request()->routeIs('department'),
                        ]) href="{{ route('department') }}">
                            <x-heroicon-s-office-building class="w-5 h-5" />
                            <span class="ml-2 text-[18px]">Department</span>
                        </a>
                    </li>
                </ul>
            @endrole
        </div>
    </aside>
</div>
