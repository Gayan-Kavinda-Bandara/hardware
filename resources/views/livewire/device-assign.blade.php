<div class="max-w-6xl mx-auto">
    <div class="flex justify-end p-2 m-2 space-x-12">
        <input type="search" wire:click="gotoPage(1)" wire:model.lazy="search" placeholder="Search..." class="block px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5">
        <x-button class="bg-indigo-600" >Search</x-button>
        <x-button class="bg-pink-600" wire:click="showDeviceAssignModal">Assign Device</x-button>
    </div>
    <div class="p-2 m-2">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">User Id</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">User Name</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Device Id</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Device Name</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Model</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Assign Date</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">state</th>
                                <th scope="col" class="relative px-6 py-3">Releasing</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr></tr>
                            @foreach ($deviceConnection as $deviceConnect)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $deviceConnect->user_id }}</td>
                                <div class="hidden">
                                    {{
                                        $test=DB::table("device_connets")
                                        ->join("users","users.id","=","device_connets.user_id")
                                        ->where("user_id","=",$deviceConnect->user_id)
                                        ->where("device_id","=",$deviceConnect->device_id)
                                        ->where("device_connets.id","=",$deviceConnect->cid)->get()
                                    }}
                                </div>
                                @foreach ($test as $data)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $data->name }}
                                </td>
                                @endforeach
                                <td class="px-6 py-4 whitespace-nowrap">{{ $deviceConnect->device_id }}</td>
                                <div class="hidden">
                                    {{
                                        $test=DB::table("device_connets")
                                        ->join("devices","devices.id","=","device_connets.device_id")
                                        ->join("device_checks","device_checks.id","=","devices.device_check_id")
                                        ->where("device_id","=",$deviceConnect->device_id)
                                        ->where("user_id","=",$deviceConnect->user_id)->get()
                                    }}
                                </div>
                                @foreach ($test as $data)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $data->main_device_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $data->model }}
                                </td>
                                @endforeach
                                <td class="px-6 py-4 whitespace-nowrap">{{ $deviceConnect->assign_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($deviceConnect->state == 1)
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 ring-1 ring-inset ring-green-600/20">Active</span>
                                    @else
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 rounded-md bg-red-50 ring-1 ring-inset ring-red-600/10">Released</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-right">
                                    <div class="flex space-x-2">
                                        <x-button wire:click="showReleaseModal({{ $deviceConnect->device_id}},  {{ $deviceConnect->user_id  }})">Releasing</x-button>                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-2 m-2">{{ $deviceConnection->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <x-dialog-modal wire:model="showingDeviceAssignModal">
            <x-slot name="title">Assign Device</x-slot>
            <x-slot name="content">
                <div>
                    <div class="mt-4">
                        <x-label for="device_id" value="{{ __('User') }}" />
                        <select input wire:model.lazy="user_id" class="block w-full mt-1" type="text" name="user_id" required autofocus autocomplete="user_id">
                        <option value="">Select User</option>

                        <div class="hidden">
                            {{
                                $test=DB::table("users")
                                ->select("users.id","name")
                                ->get()
                            }}
                        </div>

                        @foreach ($test as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                        @error('device_id') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <x-label for="device_id" value="{{ __('Device') }}" />
                        <select input wire:model.lazy="device_id" class="block w-full mt-1" type="text" name="device_id" required autofocus autocomplete="device_id">
                        <option value="">Select Device</option>

                        <div class="hidden">
                            {{
                                $test=DB::table("devices")
                                ->select("model","devices.id","main_device_name")
                                ->join("device_checks","device_checks.id","=","devices.device_check_id")
                                ->get()
                            }}
                        </div>

                        @foreach ($test as $data)
                        <option value="{{ $data->id }}">{{ $data->main_device_name }}-{{ $data->model }}</option>
                        @endforeach
                    </select>
                        @error('device_id') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <x-label for="AssignDate" value="{{ __('Assign Date') }}" />
                        <input wire:model.lazy="assign_date" class="block w-full mt-1" type="date" name="assign_date"  required autofocus autocomplete="assign_date" />
                        @error('assign_date') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button wire:click="assignDevice">Assign Device</x-button>
            </x-slot>
        </x-dialog-modal>
    </div>
    <div>
        <x-dialog-modal wire:model="showingDeviceReleaseModal">
            <x-slot name="title">Release Device</x-slot>
            <x-slot name="content">
                <div>
                    <div class="sm:col-span-6">
                        <label for="section" class="block text-sm font-medium text-gray-700"> State </label>
                        <div class="mt-1">
                            <select name="state" wire:model.lazy="state"
                                class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value=""></option>
                                @foreach (App\Models\State::orderBy('id', 'ASC')->get() as $data)
                                    <option value="{{ $data->id }}">{{ $data->state_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('state')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-label for="ReleaseDate" value="{{ __('Release Date') }}" />
                        <input wire:model.lazy="release_date" class="block w-full mt-1" type="date" name="release_date"  required autofocus autocomplete="release_date" />
                        @error('release_date') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button wire:click="relaseDevice">Release Device</x-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
