<div class="p-4 max-h-screen overflow-y-auto no-scrollbar bg-[#FEFEFE] mt-10">
    <div class="flex justify-center mb-3">
        <h4 class="text-lg text-secondary-900 font-semibold">
            Edit User Profile
        </h4>
    </div>
    <form wire:submit.prevent="submit">

        <input class="hidden"  type="file" id="image" wire:model="image" accept="image/*" wire:change="$emit('fileChosen')">
        
        <span class="text-[#4C535F]">Your Profile Picture</span>
            @if($image)
            <div class="w-32 h-32 mt-2 border-2 rounded-md cursor-pointer" wire:click="$emit('clickFile')">
                <div  id="imagIcon" class="flex justify-center h-1/2 hidden">
                    <img
                        aria-hidden="true"
                        class=" w-9 h-9 mt-4"
                        src="{{ asset('images/Rectangle.svg') }}"
                        alt=""
                    />
                </div>
                <div id="imageLable" class="flex text-center h-1/2 hidden">
                    <span class="text-[#4C535F]">Upload Your Photo</span>
                </div>
                <div>
                    @if ($errors->has('image'))
                    <div id="errorSectionDiv">
                        <div  id="imagIcon" class="flex justify-center h-1/2 ">
                            <img
                                aria-hidden="true"
                                class=" w-9 h-9 mt-4"
                                src="{{ asset('images/Rectangle.svg') }}"
                                alt=""
                            />  
                        </div>
                        <div id="imageLable" class="flex text-center h-1/2">
                            <span class="text-[#4C535F]">Upload Your Photo</span>
                        </div>
                    </div>
                    
                    
                    @else
                        <img id="uploadedImage" 
                            class="w-32 h-32 object-cover object-center rounded-md"
                            src="{{ $image->temporaryUrl() }}" 
                        />
                        {{-- Edit icon --}}
                        <div class="icon-container z-10">
                            <span class="relative top-[-23px] left-[110px]">
                                <div class="bg-white rounded-full p-1 inline-flex">
                                    <x-heroicon-s-pencil class="w-5 h-5 text-black" />
                                </div>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
            @error('image') <span class="error text-red-600 mt-4">{{ $message }}</span> @enderror
            @elseif($storedUserProfileImagePath)
                <div class="w-32 h-32 mt-2 border-1 rounded-md cursor-pointer" wire:click="$emit('clickFile')">
                    <div id="imagIcon" class="flex justify-center h-1/2 hidden">
                        <img aria-hidden="true" 
                            class=" w-9 h-9 mt-4" 
                            src="{{ asset('images/Rectangle.svg') }}"
                            alt=""
                        />
                    </div>
                    <div id="imageLable" class="flex text-center h-1/2 hidden">
                        <span class="text-[#4C535F] font-['Manrope']">Upload Your Photo</span>
                    </div>
                    <div>
                        <img class="w-32 h-32 object-cover object-center rounded-md"
                            src="{{ asset('storage/' . $storedUserProfileImagePath) }}" 
                        />
                    </div>
                    {{-- Edit icon --}}
                    <div class="icon-container z-10">
                        <span class="relative top-[-23px] left-[110px]">
                            <div class="bg-white rounded-full p-1 inline-flex">
                                <x-heroicon-s-pencil class="w-5 h-5 text-black" />
                            </div>
                        </span>
                    </div>
                </div>
            @else
                <div style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                    class="w-32 h-32 mt-2 border-dashed border-2 z-0 border-[#4C535F] rounded-2xl cursor-pointer"
                    wire:click="$emit('clickFile')">
                    <div id="imagIcon" class="flex justify-center h-1/2 ">
                        <img aria-hidden="true" 
                            class=" w-9 h-9 mt-4" 
                            src="{{ asset('images/Rectangle.svg') }}"
                            alt=""
                        />
                    </div>
                    <div id="imageLable" class="flex text-center h-1/2 ">
                        <span class="text-[#4C535F]">Upload Your Photo</span>
                    </div>
                    <div class="icon-container z-10">
                        <span class="relative top-[-23px] left-[110px]">
                            <div class="bg-white rounded-full p-1 inline-flex">
                                <x-heroicon-s-pencil class="w-5 h-5 text-black" />
                            </div>
                        </span>
                    </div>
                </div>
            @endif
    
            <hr class="mt-8 mb-5 border-t-2">
    
            <div class="flex flex-row mb-5">
                <div class="w-1/2 mr-6">
                    <x-input 
                        label="First name" 
                        placeholder="Please enter your first name" 
                        class="mt-2 border-none"
                        type="text" 
                        style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10)"
                        wire:model.debounce.500ms="name"
                    />
                </div>
                <div class="w-1/2">
                    <x-input 
                        label="Last name" 
                        placeholder="Please enter your last name" 
                        class="mt-2  border-none"
                        type="text" 
                        style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.08)"
                        wire:model.debounce.500ms="surname" 
                    />
                </div>
            </div>
    
            <div class="flex flex-row mb-5">
                <div class="w-1/2 mr-6">
                    <x-input 
                        label="Email" 
                        placeholder="Please Enter Your Email" 
                        class="mt-2 border-none" 
                        type="email"
                        style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.08)" 
                        wire:model.debounce.500ms="email" 
                    />
                </div>

                <div class="w-1/2 mb-3 border-none">
                    <x-select
                        wire:model="department"
                        style="border: none; padding: 3%" 
                        label="Department"
                        placeholder="Please select your department name" 
                        class="mt-1 border-none"
                        style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.08)"
                        >
                       @forelse($this->allDepartment as $department)
                       {{$department->id}}
                            <x-select.option  value="{{$department->id}}"
                                :selected="$department === strval($department->id) ">{{ $department->name }}</x-select.option>
                        @empty
                        @endforelse
                    </x-select>
                </div>
            </div>
            <div class="flex flex-col md:flex-row md:justify-between lg:justify-between items-center">
                <div class=" text-white w-auto">
                    <button
                        class=" w-auto text-lg font-medium  text-white px-8 py-3 rounded-lg font-['Inter'] bg-sky-500 hover:bg-sky-600 mb-2 flex flex-row items-center gap-2 justify-center"
                        type="submit">
                        <span wire:target="submit" wire:loading.remove
                            class="flex flex-row items-center gap-2 justify-center">
                            Update Profile
                        </span>
                        <span wire:loading wire:target="submit">
                            <p class="flex">Please wait... <x-loader /></p>
                        </span>
                    </button>
                </div>
            </div>
            
        </div>
    </form>
</div>

<script>

    window.Livewire.on('clickFile', ()=> {
        document.getElementById('image').click();
    })

    </script>
    
