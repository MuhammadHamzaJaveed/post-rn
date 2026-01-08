<div>
    <div>
        <div>
            <div class="flex flex-col mt-8 p-2 px-6">
                <div class="py-2 -my-2 overflow-x-hidden sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="inline-block min-w-full overflow-hidden align-middle border-b border-purple-200 shadow sm:rounded-lg">
                        <div class="flex justify-between items-center p-2 px-6">
                            <button
                            style="border-radius: 3px;
                            background: rgba(0, 174, 198, 0.80);" 
                            class="p-2 px-6 rounded-md purple-500 hover:bg-purple-400 text-white"
                            onclick='Livewire.emit(
                                                "openModal",
                                                "components.create-edit-department.create-edit-department",
                                           )'>
                               Add New Department
                            </button>

                            <x-input
                                    placeholder="Search By Name"
                                    class="mb-6 rounded-full border-purple-500"
                                    type="text"
                                    wire:model.debounce.500ms="searchByName"
                            />
                        </div>

                        <table class="min-w-full">
                            <x-departmentTableHead />

                            <tbody class="bg-white">
                                <tr >
                                    <td >
                                        <td></td>
                                        <td class="text-center" wire:loading>
                                            <x-loader.loader />
                                        </td>
                                        <td></td>
                                    </td>
                                </tr>
                                @php
                                    $iteration = 1;
                                @endphp
                                @forelse($this->allDepartment as $department)
                                    <tr wire:loading.remove>
                                        <td  class="py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium leading-5 text-gray-900">
                                                        {{ $iteration }}
                                                        @php
                                                            $iteration++;
                                                        @endphp
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ $department->name }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{$department->users->count()}}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-sm leading-5 cursor-pointer text-gray-500 whitespace-no-wrap border-b border-gray-200"
                                            onclick='Livewire.emit(
                                                    "openModal",
                                                    "components.create-edit-department.create-edit-department",
                                                    {{ json_encode([
                                                        "departmentId" => $department->id,
                                                       ])
                                                    }}
                                               )'>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0
                                                112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </td>
                                    </tr>
                                @empty
                                    <tr wire:loading.remove>
                                        <td colspan="4">
                                            <div class="text-lg items-center justify-center flex p-6 text-center">
                                                No Department Found
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4 ml-4 mb-4">
                    {{ $this->allDepartment->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

