@role('Admin')
<div>
    <div>
        <div>
            <div class="flex flex-col mt-8 p-2 px-6">
                <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="inline-block min-w-full overflow-hidden align-middle border-b border-purple-200 shadow sm:rounded-lg">
                        <div class="justify-end flex p-2 px-6">

                            <x-input
                                    placeholder="Search By Name"
                                    class="mb-6 rounded-full border-purple-500 h-full"
                                    type="text"
                                    wire:model.debounce.500ms="searchByName"
                            />
                        </div>

                        <table class="min-w-full w-full">
                            <x-tableHead />

                            <tbody class="bg-white">
                                <tr >
                                    <td >
                                        <td></td>
                                        <td class="text-center items-center" wire:loading>
                                            <x-loader.loader />
                                        </td>
                                        <td colspan="2"></td>
                                    </td>
                                </tr>
                            @forelse($this->allUsers as $user)
                           
                                <tr wire:loading.remove>
                                    <td class="py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium leading-5 text-gray-900">
                                                    {{ $user->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $user->email }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $user->surname }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $user->roles[0]->name }}</div>
                                    </td>

                                    <td class=" flex px-6 py-4 text-sm leading-5 cursor-pointer text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        <div 
                                            class="cursor-pointer mr-2"
                                            onclick='Livewire.emit(
                                            "openModal",
                                            "components.create-edit-user-form.create-edit-user-form",
                                            {{ json_encode([
                                                "userId" => $user->id,
                                               ])
                                            }}
                                       )'>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0
                                            112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>

                                        <div
                                                class="cursor-pointer ml-2"
                                                onclick='Livewire.emit(
                                                "openModal",
                                                "components.delete-action.delete-action",
                                                {{ json_encode([
                                                    "deleteItemId" => $user->id,
                                                   ])
                                                }}
                                           )'
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5
                                             7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr wire:loading.remove>
                                    <td colspan="5">
                                        <div class="text-lg items-center justify-center flex p-6 text-center">
                                            No Users Found
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4 ml-4 mb-4">
                    {{ $this->allUsers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endrole
