{{--
<x-filament::widget class="col-span-12">
    <div class="flex gap-3">
        <div class="col-span-6">
            <x-filament::card>
                <section class="">
                    <div class="flex flex-col justify-center">
                        <div class="flex flex-col h-full shadow justify-between rounded-lg pb-8 p-6 xl:p-8 mt-3 bg-gray-50">
                            <div>
                                <h4 class=" font-bold text-2xl text-red-600 leading-tight">Notice</h4>
                                <div class="my-4">
                                    <p>
                                        If student wants to change his /her upgradation choice, he/she must contact the respective college within three days of display of last selection list
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </x-filament::card>
        </div>
        <div class="col-span-6">
            <x-filament::card>
                <section class="">
                    <div class="flex flex-col justify-center">
                        <div class="flex flex-col h-full shadow justify-between rounded-lg pb-8 p-6 xl:p-8 mt-3 bg-gray-50">
                            <div>
                                <h4 class=" font-bold text-2xl leading-tight">Quick Start</h4>
                                <div class="my-4">
                                    <p>Please Download the Joining Report and fill it with the required information and upload it here.</p>
                                </div>
                            </div>
                            <div><a class="mt-1 inline-flex font-bold items-center border-2 border-transparent outline-none focus:ring-1 focus:ring-offset-2 focus:ring-link active:bg-link active:text-gray-700 active:ring-0 active:ring-offset-0 leading-normal bg-link text-gray-700 hover:bg-opacity-80 text-base rounded-lg py-1.5"
                                    aria-label="Quick Start" target="_self" href="">Download Joining report modification<svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                            class="duration-100 ease-in transition -rotate-90 inline ml-1"
                                            style="min-width:20px;min-height:20px">
                                        <g fill="none" fill-rule="evenodd" transform="translate(-446 -398)">
                                            <path fill="currentColor" fill-rule="nonzero"
                                                  d="M95.8838835,240.366117 C95.3957281,239.877961 94.6042719,239.877961 94.1161165,240.366117 C93.6279612,240.854272 93.6279612,241.645728 94.1161165,242.133883 L98.6161165,246.633883 C99.1042719,247.122039 99.8957281,247.122039 100.383883,246.633883 L104.883883,242.133883 C105.372039,241.645728 105.372039,240.854272 104.883883,240.366117 C104.395728,239.877961 103.604272,239.877961 103.116117,240.366117 L99.5,243.982233 L95.8838835,240.366117 Z"
                                                  transform="translate(356.5 164.5)"></path>
                                            <polygon points="446 418 466 418 466 398 446 398"></polygon>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </x-filament::card>
        </div>
    </div>
</x-filament::widget>
--}}

<x-filament::widget class="col-span-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-filament::card class="flex flex-col h-full w-full">
            <section class="h-full">
                <div class="flex flex-col h-full justify-between rounded-lg pb-8 p-6 xl:p-8 bg-gray-50">
                    <div>
                        <h4 class="font-bold text-2xl text-red-600 leading-tight">Notice</h4>
                        <div class="mt-4">
                            <p>
                                If a student wants to change his/her upgradation choice, they must contact the respective college within three days of display of the last selection list.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </x-filament::card>

        <x-filament::card class="flex flex-col h-full w-full">
            <section class="h-full">
                <div class="flex flex-col h-full justify-between rounded-lg pb-8 p-6 xl:p-8 bg-gray-50">
                    <div>
                        <h4 class="font-bold text-2xl text-red-600  leading-tight">Note</h4>
                        <div class="mt-4">
                            <p>
                                Please download the Joining report Required For Modification.
                            </p>
                        </div>
                    </div>
                    <div>
                        <a class="mt-1 inline-flex font-bold items-center border-2 border-transparent outline-none focus:ring-1 focus:ring-offset-2 focus:ring-link active:bg-link active:text-gray-700 active:ring-0 active:ring-offset-0 leading-normal bg-link text-gray-700 hover:bg-opacity-80 text-base rounded-lg py-1.5 px-4 hover:underline"
                           aria-label="Quick Start" target="_self" href="{{asset('Joining_report_modification.pdf')}}">
                            Download Joining report modification
                            <svg data-slot="icon" fill="none" class="ml-3" height="20" width="20" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        </x-filament::card>
    </div>
</x-filament::widget>
