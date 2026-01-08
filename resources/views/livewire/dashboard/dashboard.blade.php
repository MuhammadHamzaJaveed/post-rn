 <div class="bg-[#FBFCFC] w-full">
    <div class="flex flex-col w-full mb-7 ">
        <div class="bg-[#fefefe] flex flex-col gap-6 pl-3 h-[534px] shrink-0 items-start px-2 py-0 rounded-lg">
            <div class="bg-transparent text-2xl font-['Inter'] font-light pt-3 pl-5">
               Admission Form
            </div>
            @role(['Admin','Manager'])
            <div class=" pl-3 grid grid-cols md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                <!-- Card -->
                    <div
                        class=" w-80 xl:mx-0 lg:mx-0 md:mx-auto sm:mx-auto my-3 md:flex md:flex-col sm:flex sm:flex-col shadow-[0px_4px_20px_0px_rgba(0,_0,_0,_0.2)] p-3 pb-10 justify-center bg-[#fbfcfc] rounded-lg">
                        <div class="p-3 h-3/4 rounded-lg bg-[rgba(0,_174,_198,_0.8)]">
                            <div>
                                <img aria-hidden="true" class="pt-3 pl-4 object-cover w-auto h-auto rounded"
                                    src="{{ asset('images/bar.svg') }}" alt="Office" />
                            </div>
                        </div>
    
                        <div class="flex flex-col gap-1 items-center justify-center ml-px mr-1">
                            <div
                                class="justify-center whitespace-nowrap text-[18px] font-['Inter'] font-medium pt-4 text-center">
                                New Teardown
                            </div>
                            <div class="text-center text-[16px] font-['Inter'] font-extralight self-stretch">
                                Create a new teardown report
                            </div>
                        </div>
                    </div>
                </a>
                <div
                    class=" w-80  xl:mx-0 lg:mx-0 md:mx-auto sm:mx-auto my-3 md:flex md:flex-col sm:flex sm:flex-col   shadow-[0px_4px_20px_0px_rgba(0,_0,_0,_0.2)] p-3 pb-10 justify-center bg-[#fbfcfc] rounded-lg ">
  
                    <div class="p-3 h-3/4 rounded-lg bg-[rgba(0,_174,_198,_0.8)]">
  
                        <div>
                            <img aria-hidden="true" class="pt-5 object-center object-cover w-full rounded"
                                src="{{ asset('images/broler.png') }}" alt="Office" />
                        </div>
                    </div>
  
                    <div class="flex flex-col gap-1 items-center justify-center ml-px mr-1">
                        <div
                            class="justify-center whitespace-nowrap text-[18px] font-['Inter'] font-medium pt-4 text-center">
                            Competitors Unit
                        </div>
                        <div class="text-center text-[16px] font-['Inter'] font-extralight self-stretch">
                            Search for competitors units </div>
                    </div>
                </div>
  
                <div
                    class=" w-80 xl:mx-0 lg:mx-0 md:mx-auto sm:mx-auto my-3 md:flex md:flex-col sm:flex sm:flex-col  shadow-[0px_4px_20px_0px_rgba(0,_0,_0,_0.2)] p-3 pb-3 items-center bg-[#fbfcfc] rounded-lg shadow-xs">
                    <div class="p-3 h-3/4 rounded-lg bg-[rgba(0,_174,_198,_0.8)]">
                        <div>
                            <img aria-hidden="true" class="mt-4 object-cover object-center w-full h-full rounded"
                                src="{{ asset('images/laptop.svg') }}" alt="Office" />
                        </div>
                    </div>
  
                    <div class="flex flex-col gap-1 items-center justify-center ml-px mr-1">
                        <div
                            class="justify-center whitespace-nowrap text-[18px] font-['Inter'] font-medium pt-4 text-center">
                            Components
                        </div>
                        <div class="text-center text-[16px] font-['Inter'] font-extralight self-stretch">
                            Search for components from Teardowns </div>
                    </div>
                </div>
  
               
            </div>
            @endrole
        </div>
  
    </div>
  </div>
  
  
