<div class="h-8 bg-[#25282D] hidden md:block"></div>
<header class="z-10 py-2 bg-[#FBFCFC] rounded-tl-md mt-[-10px] ml-0 ">
    <div class="container flex items-center  justify-between h-full px-6 mx-auto text-purple-600">
        <!-- Mobile hamburger -->
        <button
                class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                x-on:click="toggleSideMenuOpen()"
                aria-label="Menu"
        >

            <x-heroicon-o-menu class="w-6 h-6"/>
        </button>
        <!-- Search input -->
        <div class="flex justify-start flex-1 lg:ml-2">
            <div class="relative w-full max-w-2xl mr-6 focus-within:text-purple-500 flex items-center justify-end">
                
                <input
                        class="w-full pl-7 py-[6px] text-md text-black placeholder-[#B4B1B1] bg-white border-0 shadow-[0px_4px_20px_0px_rgba(0,_0,_0,_0.12)]
                        rounded-[27px] focus:placeholder-gray-500 focus:bg-white focus:border-purple-300
                        focus:outline-none focus:shadow-outline-purple form-input placeholder:font-['Inter'] placeholder:text-sm"
                        type="text"
                        placeholder="Search"
                        aria-label="Search"
                />
                <div class="absolute inset-y-0 flex items-center pr-4">
                    <x-heroicon-o-search class="w-4 h-4 text-[#606060]"/>
                </div>
            </div>
        </div>

        <ul class="flex items-center flex-shrink-0 space-x-6">
            <!-- Profile menu -->
            <div class="my-7"
                 x-data="{ isProfileMenuOpen: false,
                             toggleProfileMenu() {
                                 if (this.isProfileMenuOpen) {
                                    return this.closeProfileMenu()
                                 }
                                 this.isProfileMenuOpen = true
                             },
                             closeProfileMenu() {
                                 if (! this.isProfileMenuOpen) return
                                 this.isProfileMenuOpen = false
                             }
                         }"
            >
                <li class="relative">
                    <button
                            class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                            @click="toggleProfileMenu"
                            @keydown.escape="closeProfileMenu"
                            aria-label="Account"
                            aria-haspopup="true"
                    >
                        <div class="flex items-center justify-center">
                            @if(auth()->user()->image()->count() != 0)
                                <img
                                    class="object-cover w-8 h-8 rounded-full"
                                    src="{{ asset('storage/' . auth()->user()->image()->first()->path) }}"
                                    alt=""
                                    aria-hidden="true"
                                />
                            @else
                                <div style="box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.12);" class="w-11 h-11 rounded-full flex items-center justify-center bg-white">
                                    <x-heroicon-s-user class="w-6 h-6 text-[#606060]" />
                                </div>
                            @endif
                        </div>
                        <span>{{auth()->user()->name}}</span>
                    </button>

                    <div x-cloak x-show="isProfileMenuOpen">
                        <ul
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                @click.away="closeProfileMenu"
                                @keydown.escape="closeProfileMenu"
                                class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md"
                                aria-label="submenu"
                        >
                            <li class="flex">
                                <a
                                        class="inline-flex items-center w-full px-2 py-2 text-sm font-semibold
                                        transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                                        href="{{ route('create-edit-user-profile') }}"
                                >
                                    <x-heroicon-o-user class="w-4 h-4 mr-3"/>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li class="flex">
                                <a class="inline-flex items-center w-full px-2 py-2 text-sm font-semibold transition-colors
                                          duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                                   href="#"
                                >
                                    <x-heroicon-o-cog class="w-4 h-4 mr-3"/>
                                    <span>Settings</span>
                                </a>
                            </li>
                            <li class="flex">
                                <span
                                    class="transition-
                                colors  duration-150 hover:bg-gray-100 hover:text-gray-800 w-full rounded-md ">
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-jet-dropdown-link
                                            class=" inline-flex rounded-md items-center w-full text-sm font-semibold"
                                            href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            <x-heroicon-o-logout class="w-4 h-4 mr-3 ml-[-6px]" />

                                            {{ __('Log Out') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </span>
                            </li>
                        </ul>
                    </div>
                </li>
            </div>
        </ul>
    </div>
</header>
