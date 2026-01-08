<aside class="z-20 hidden lg:w-[15%] overflow-y-auto bg-[#25282D] md:block flex-shrink-0 md: w-auto">
    <div class="py-6">
        <div class="flex items-center ml-4">
        <img src="{{ asset('images/img-logo.png') }}" alt="Rkees-logo" class="rounded-full w-[45.89px] h-[45.30px]">
        <a class="text-[20px] font-['Inter'] font-medium text-[#F3F1F1] ml-3"
           href="#"
        >
            UHS App
        </a>
        </div>
        <div class="pt-8 text-[#F8FAFB] font-['Inter']">
        @role(['Admin','Applicant'])
        <ul class="mt-6">
            <li class="relative px-1 py-3">
                @if(request()->routeIs('dashboard'))
                  <span class="absolute left-0 w-1 bg-white w-1 h-[25px] "
                        aria-hidden="true"
                  ></span>
                @endif

                <a
                        @class([
                            'inline-flex items-center w-full text-[18px] font-normal transition-colors
                            duration-150 hover:text-[#00AEC6] ',
                            'text-white' => request()->routeIs('dashboard')
                        ])
                        href="{{ route('dashboard') }}"
                >
                    <x-heroicon-s-home class="w-5 h-5 ml-[25px]"/>
                    <span class="ml-2 text-[18px] ">Dashboard</span>
                </a>
            </li>
        </ul>
        @endrole
        @role('Admin')
        <ul>
            <li class="relative px-1 py-3">
                @if(request()->routeIs('user-details'))
                     <span class="absolute left-0  bg-white w-1 h-[25px] "
                           aria-hidden="true"
                     ></span>
                @endif
                <a
                        @class([
                            'inline-flex items-center w-full text-[18px] font-normal transition-colors
                            duration-150 hover:text-[#00AEC6] ',
                            'text-white' => request()->routeIs('user-details')
                        ])
                   href="{{ route('user-details') }}"
                >
                    <x-heroicon-s-user class="w-5 h-5 ml-[25px]"/>
                    <span class="ml-2 text-[18px]">User</span>
                </a>
            </li>
        </ul>

        <ul>
            <li class="relative px-1 py-3">
                @if(request()->routeIs('department'))
                     <span class="absolute left-0  bg-white w-1 h-[25px] "
                           aria-hidden="true"
                     ></span>
                @endif
                <a
                        @class([
                            'inline-flex items-center w-full text-[18px] font-normal transition-colors
                            duration-150 hover:text-[#00AEC6] ',
                            'text-white' => request()->routeIs('department')
                        ])
                   href="{{ route('department') }}"
                >
                <x-heroicon-s-office-building class="w-5 h-5 ml-[25px]" />
                    <span class="ml-2 text-[18px]">Department</span>
                </a>
            </li>
        </ul>
        @endrole
        </div>
    </div>
</aside>
