<div class="p-4 max-h-screen overflow-y-auto no-scrollbar shadow-xl">
        <div class="flex justify-left mb-5">
            <h4 class="text-3xl text-secondary-900 font-bold">
                {{ $heading }}
            </h4>
        </div>
    
        <form wire:submit.prevent="submit">
            <div class="grid grid-cols-2 gap-4" >
                    <div>        
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            value="{{ __('Creation Date') }}"
                                    />
                            </label>        
                                    <x-input
                                            
                                            class="mt-4"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            type="text"
                                            wire:model.debounce.500ms="creationDate"
                                            readonly
                                    />
                    </div>
                    <div>        
                                    <label class="block text-sm mt-4">
                                            <x-jet-label
                                                    class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                                    value="{{ __('Category') }}"
                                            />
                                    </label>        
                                    <x-select  class="mt-4" style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10); border:none" placeholder="Please select category" wire:model.defer="categoryGroup">
                                            <x-select.option label="Residential" value="Residential"/>
                                            <x-select.option label="Commercial" value="Commercial"/>
                                    </x-select>
                    </div>
            
                    <div>
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            value="{{ __('Fuel Type') }}"
                                    />
                            </label>
                                    <x-select class="mt-4" style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10); border:none" placeholder="Please select fuel type" wire:model.debounce.500ms="fuelType">
                                    <x-select.option label="Gas" value="Gas"/>
                                    <x-select.option label="Electric" value="Electric"/>
                                    <x-select.option label="Hybrid" value="Hybrid"/>
                                    </x-select>
                    </div>        
                    <div>
    
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="PT" value="{{ __('Product Type') }}"
                                    />
                            </label>        
                                    <x-select id="PT" class="mt-4" style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10); border:none" placeholder="Please select product type" wire:model.defer="productType">
                                    @if($fuelType!='Hybrid')    
                                    <x-select.option label="Storage" value="Storage"/>
                                    <x-select.option label="Tankless" value="Tankless"/>
                                    @endif
                                    <x-select.option label="HPWH Integrated" value="HPWH Integrated"/>
                                    <x-select.option label="HPWH Monobloc" value="HPWH Monobloc"/>
                                    @if($fuelType=='Gas')
                                    <x-select.option label="HPWH Split" value="HPWH Split"/>
                                    <x-select.option label="Combi Boiler" value="Combi Boiler"/>
                                    @endif
                                    </x-select>
                    </div>
                            
                    <div>
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="brand" value="{{ __('Brand') }}"
                                    />
                            </label>        
                                    <x-select id="brand" style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10); border:none" class="mt-4" placeholder="Please select brand" wire:model.defer="brand">
                                    <x-select.option label="AO Smith" value="AO Smith"/>
                                    <x-select.option label="Bradford White" value="Bradford White"/>
                                    <x-select.option label="American Standard" value="American Standard"/>
                                    <x-select.option label="GE/Haier" value="GE/Haier"/>
                                    <x-select.option label="Rinnai" value="Rinnai"/>
                                    <x-select.option label="Navien" value="Navien"/>
                                    <x-select.option label="Noritz" value="Noritz"/>
                                    </x-select>
                    </div>
                    <div>        
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="IR" value="{{ __('Input Rate') }}"
                                    />
                            </label>        
                                    <x-select id="IR" style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10); border:none" class="mt-4" placeholder="Please select input rate" wire:model="inputRate">
                                    <x-select.option label="Btu/h" value="Btu/h"/>
                                    <x-select.option label="kW" value="kW"/>
                                    <x-select.option label="Ton" value="Ton"/>
                                    <x-select.option label="Other" value="Other"/>
                                    </x-select>
                                    
                                    @if($inputRate=='Other')
                                    <x-input
                                            id="IRO"
                                            placeholder="Other Input Rate"
                                            class="mt-4"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            type="text"
                                            wire:model="inputRateFinal"
                                    />
                                    @endif
                    </div>
                    <div>        
    
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="MMN" value="{{ __('Marketing Model Number') }}"
                                    />
    
                                    <x-input
                                            id="MMN"
                                            placeholder="xxxxxxxxxxxx"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            class="mt-4"
                                            type="text"
                                            wire:model.debounce.500ms="marketingModelNumber"
                                    />      
                            </label>
                    </div>
                    <div>        
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="SN" value="{{ __('Serial Number') }}"
                                    />
                                    <x-input
                                            id="SN"
                                            placeholder="Enter serial number"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            class="mt-4"
                                            type="text"
                                            wire:model.debounce.500ms="serialNumber"
                                    />
                            </label>
                    </div>
                    <div>        
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="SC" value="{{ __('Store Capacity') }}"
                                    />
                                    <x-input
                                            id="SC"
                                            placeholder="0 Gallons"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            class="mt-4"
                                            type="number"
                                            wire:model.debounce.500ms="storeCapacity"
                                    />
                            </label>
                    </div>
                    <div>        
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="WP" value="{{ __('Warranty Period') }}"
                                    />
    
                                    <x-input
                                            id="WP"
                                            placeholder="Enter warranty period"
                                            class="mt-4"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            type="number"
                                            wire:model.debounce.500ms="warrantyPeriod"
                                    />
                            </label>
                    </div>
                    <div>        
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="UW" value="{{ __('Unit Weight') }}"
                                    />
    
                                    <x-input
                                            id="UW"
                                            placeholder="0 lbs"
                                            class="mt-4"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            type="number"
                                            wire:model.debounce.500ms="unitWeight"
                                    />
                            </label>
                    </div>
                    <div>        
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="UD" value="{{ __('Unit Dimension') }}"
                                    />
    
                                    <x-input
                                            id="UD"
                                            placeholder="0 inches"
                                            class="mt-4"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            type="number"
                                            wire:model.debounce.500ms="unitDimension"
                                    />
                            </label>
                    </div>  
                    <div>      
                                <label class="block text-sm mt-4">       
                                        <x-jet-label
                                                class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                                value="{{ __('Box Dimensions (LxWxH)') }}"
                                        />
                                        <div class='flex flex-row'>
                                        <div div class='justify-content-start mt-4'>
                                
                                                <div>        
                                                        <x-input
                                                                id="BDH"
                                                                placeholder="Length (inches)"
                                                                type="number"
                                                                wire:model.debounce.500ms="boxDimensionHeight"
                                                        />
                                                </div>        
                                        </div>
                                        <div class='justify-content-start mt-4'>

                                                <div class='ml-4'>        
                                                        <x-input
                                                                id="BDW"
                                                                placeholder="Width (inches)"
                                                                type="number"
                                                                wire:model.debounce.500ms="boxDimensionWidth"
                                                        />
                                                </div>        
                                        </div>
                                        <div class='justify-content-start mt-4'> 
                                        
                                                <div class='ml-4'>       
                                                        <x-input
                                                                id="BDL"
                                                                placeholder="Height (inches)"
                                                                type="number"
                                                                wire:model.debounce.500ms="boxDimensionLength"
                                                        />
                                                </div>
                                        </div>
                                        </div>
                                </label>
                    </div>            
                    <div>
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="BW" value="{{ __('Box Weight') }}"
                                    />
    
                                    <x-input
                                            id='BW'
                                            placeholder="0 lbs"
                                            class="mt-4"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            type="number"
                                            wire:model.debounce.500ms="boxWeight"
                                    />
                            </label>
                    </div>
                    <div>        
    
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="SP" value="{{ __('Sale Price') }}"
                                    />
    
                                    <x-input
                                            id='SP'
                                            placeholder="$100"
                                            class="mt-4"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            type="number"
                                            wire:model.debounce.500ms="salePrice"
                                    />
                            </label>
                    </div>
                    <div>        
    
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="TL" value="{{ __('Total labels') }}"
                                    />
                                    <x-input
                                            id='TL'
                                            placeholder="Enter total labels"
                                            class="mt-4"
                                            style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                            type="number"
                                            wire:model.debounce.500ms="totalLabels"
                                    />
                            </label>
                    </div>
                    <div>        
    
                            <label class="block text-sm mt-4">
                                    <x-jet-label
                                            class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]"
                                            for="PN" value="{{ __('Project Name') }}"
                                    />
                                    <x-input
                                    id='PN'
                                    class="mt-4"
                                    style="box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);"
                                    type="text"
                                    wire:model.debounce.500ms="projectName"
                                    readonly/>
                            </label>
                    </div>
                <div>
        </div>   
                    
                    {{-- Upload Images Section --}}

                    <div class="w-full ml-1 mt-6 mb-8">
                            <div>    
                            <div class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]">Images of the Box</div>
                            <div class="flex flex-col md:flex-row gap-4">
                                    <div class="flex-shrink-0 w-[20%] pt-4">
                                            <div class=" border-dashed border-[#4c535f] bg-white flex flex-col gap-2 items-center px-3 py-4 rounded-lg" style="border: 0.667px dashed #4C535F; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);">
                                                <img src="https://file.rendit.io/n/JfTJhV9U40knbxwDR8jF.svg" class="min-h-0 min-w-0 w-8" />
                                                <div class="text-center text-xs font-['Manrope'] font-normal text-[#4c535f] ">
                                                    Upload your photo
                                                </div>
                                                <input type="file" id="imageUploadInput" class="hidden" accept="image/*">
                                            </div>
                                        </div>
                                        
                                <div class="flex-shrink-0 w-[20%] pt-4">
                                    <div class="border-dashed border-[#4c535f] shadow-[0px_0px_20px_0px_rgba(0,_0,_0,_0.1)] bg-white flex flex-col gap-2 items-center px-3 py-4 border rounded-lg"
                                    style="border: 0.667px dashed #4C535F; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);">
                                        <img src="https://file.rendit.io/n/JfTJhV9U40knbxwDR8jF.svg" class="min-h-0 min-w-0 w-8" />
                                        <div class="text-center text-xs font-['Manrope'] font-normal text-[#4c535f] self-stretch">
                                            Upload your photo
                                        </div>
                                        <input type="file" id="imageUploadInput" class="hidden" accept="image/*">
                                    </div>
                                </div>
                                <div class="flex-shrink-0 w-[20%] pt-4">
                                    <div class="border-dashed border-[#4c535f] shadow-[0px_0px_20px_0px_rgba(0,_0,_0,_0.1)] bg-white flex flex-col gap-2 items-center px-3 py-4 border rounded-lg" 
                                    style="border: 0.667px dashed #4C535F; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);">
                                        <img src="https://file.rendit.io/n/JfTJhV9U40knbxwDR8jF.svg" class="min-h-0 min-w-0 w-8" />
                                        <div class="text-center text-xs font-['Manrope'] font-normal text-[#4c535f] self-stretch">
                                            Upload your photo
                                        </div>
                                        <input type="file" id="imageUploadInput" class="hidden" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='mt-6'>
                        <div class="block  text-sm font-['Manrope'] font-medium text-[#4c535f]">Images of the Unit</div>
                            <div class="flex flex-col md:flex-row gap-4">
                                    <div class="flex-shrink-0 w-[20%] pt-4">
                                            <div class=" border-dashed border-[#4c535f] bg-white flex flex-col gap-2 items-center px-3 py-4 rounded-lg" style="border: 0.667px dashed #4C535F; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);">
                                                <img src="https://file.rendit.io/n/JfTJhV9U40knbxwDR8jF.svg" class="min-h-0 min-w-0 w-8" />
                                                <div class="text-center text-xs font-['Manrope'] font-normal text-[#4c535f] ">
                                                    Upload your photo
                                                </div>
                                                <input type="file" id="imageUploadInput" class="hidden" accept="image/*">
                                            </div>
                                        </div>
                                        
                                <div class="flex-shrink-0 w-[20%] pt-4">
                                    <div class="border-dashed border-[#4c535f] shadow-[0px_0px_20px_0px_rgba(0,_0,_0,_0.1)] bg-white flex flex-col gap-2 items-center px-3 py-4 border rounded-lg"
                                    style="border: 0.667px dashed #4C535F; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);">
                                        <img src="https://file.rendit.io/n/JfTJhV9U40knbxwDR8jF.svg" class="min-h-0 min-w-0 w-8" />
                                        <div class="text-center text-xs font-['Manrope'] font-normal text-[#4c535f] self-stretch">
                                            Upload your photo
                                        </div>
                                        <input type="file" id="imageUploadInput" class="hidden" accept="image/*">
                                    </div>
                                </div>
                                <div class="flex-shrink-0 w-[20%] pt-4">
                                    <div class="border-dashed border-[#4c535f] shadow-[0px_0px_20px_0px_rgba(0,_0,_0,_0.1)] bg-white flex flex-col gap-2 items-center px-3 py-4 border rounded-lg" 
                                    style="border: 0.667px dashed #4C535F; box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.10);">
                                        <img src="https://file.rendit.io/n/JfTJhV9U40knbxwDR8jF.svg" class="min-h-0 min-w-0 w-8" />
                                        <div class="text-center text-xs font-['Manrope'] font-normal text-[#4c535f] self-stretch">
                                            Upload your photo
                                        </div>
                                        <input type="file" id="imageUploadInput" class="hidden" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                 </div>                        
             
            {{-- Submit Button Section  --}}

            <div class="rounded-md text-white mt-6">
                <button
                style="border-radius: 3px;
                background: rgba(0, 174, 198, 0.80);" 
                class="text-lg text-white p-2 mb-2 px-14 rounded"
                type="submit">
                    <span wire:target="submit" wire:loading.remove class="flex flex-row items-center gap-2 justify-center">
                        Save Teardown
                    </span>
                    <span wire:loading wire:target="submit">
                        <p class="flex">Please wait... <x-loader /></p>
                    </span>
                </button>
            </div>
        </form>
    </div>
    