<nav class="px-[1rem] md:px-[3.6rem] flex flex-col md:flex-row items-center justify-between p-3 bg-gray-100 shadow-md">
    <div class="flex items-center space-x-4 mb-2 md:mb-0 md:mr-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-14 h-14">
        <div>
            <span class="uni-name text-green-800 font-bold text-lg font-sans">University Of Health Sciences</span>
            <span class="sub block text-red-600 text-xs font-sans">For World Class Professionals</span>
        </div>
    </div>
    <div class="flex items-center space-x-4">
    <div class="bell-icon">
        <p class="font-medium">Application ID: {{auth()->user()->id}}</p>
    </div>
    <div class="border-l-2 border-gray-300 h-10 mx-4 hidden md:block"></div>
    <div class="w-10 h-10 overflow-hidden rounded-full" x-data="{ isProfileMenuOpen: false }">
        <img
            src="{{ $image }}"
            alt="User Image"
            class="w-full h-full object-cover cursor-pointer"
            @click="isProfileMenuOpen = !isProfileMenuOpen"
        >

        <!-- Profile Menu -->
        <div
            x-cloak
            x-show="isProfileMenuOpen"
            @click.away="isProfileMenuOpen = false"
            class="absolute right-0 mt-2 w-72 p-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md z-10"
            aria-label="submenu"
        >
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <span class="inline-flex ml-[-6px]"><x-heroicon-o-user-circle class="w-6 h-6 mr-3 ml-3" />
                <p class="rounded-md items-center w-full text-sm font-semibold text-black font-sans hidden md:block"> {{ auth()->user()->name }}</p>
                </span>
                <x-jet-dropdown-link
                    class="inline-flex rounded-md items-center w-full text-sm font-semibold"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                >
                    <x-heroicon-o-logout class="w-4 h-4 mr-3 ml-[-6px]" />
                    {{ __('Log Out') }}
                </x-jet-dropdown-link>
            </form>
        </div>
        <!-- End Profile Menu -->
    </div>
    {{--<p class="text-black font-sans hidden md:block">Welcome, {{ auth()->user()->name }}</p>--}}
</div>
</nav>
