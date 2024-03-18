<div class="max-w-6xl mx-auto">
    <div class="flex justify-end p-2 m-2 space-x-12">
        <input type="search" wire:click="gotoPage(1)" wire:model.lazy="search" placeholder="Search..." class="block px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5">
        <x-button class="bg-lime-600" >Search</x-button>
        <x-button class="bg-green-600" wire:click="showDeviceModal">Add Device</x-button>
    </div>
    <div class="p-2 m-2">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Id</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Device Name</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Serial No</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Brand</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Model</th>
                      <th scope="col" class="relative px-6 py-3">Edit/Delete</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    @foreach ($devices as $device)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $device->id }}</td>
                        @if($device->device_check_id == 6)
                            <td class="px-6 py-4 whitespace-nowrap">{{ $device->other_device_name }}</td>
                        @else
                            <div class="hidden">
                            {{
                                $test=DB::table("devices")
                                ->join("device_checks","device_checks.id","=","devices.device_check_id")
                                ->where("device_check_id","=",$device->device_check_id)->get()
                            }}
                        </div>
                        @foreach ($test as $data)
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $data->main_device_name }}
                        </td>
                        @endforeach
                        @endif
                        <td class="px-6 py-4 whitespace-nowrap">{{ $device->serial_no }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $device->brand }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $device->model }}</td>
                        <td class="px-6 py-4 text-sm text-right">
                            <div class="flex space-x-2">
                                <div>
                                    <x-button wire:click="showEditDeviceModal({{ $device->id }})">Edit</x-button>
                                </div>
                                <div>
                                    <div class="alert"
                                    :class="{primary:'alert-primary',success:'alert-success',danger:'alert-danger',warning:'alert-warning'}[(alert.type??'primary')]"
                                    x-data="{open:false,alert:{}}"
                                    x-show="open" x-cloak
                                    @alert.window="open = true; setTimeout( ()=> open=false,3000); alert=$event.detail[0]">
                                    <div class="alert-wrapper">
                                    <strong x-html="alert.title"></strong>
                                    <p x-html="alert.message"></p>
                                    </div>
                                    <i class="alert-close fa-solid fa-xmark" @click="open=false"></i>
                                    </div>
                                    <x-button class="bg-red-400 hover:bg-red-600" wire:click="deleteDevice({{ $device->id }})">Delete</x-button>
                                </div>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="p-2 m-2">{{ $devices->links() }}</div>
              </div>
            </div>
          </div>
    </div>
    <div>
        <x-dialog-modal wire:model="showingDeviceModal">
            @if ($isEditMode)
            <x-slot name="title">Update Device</x-slot>
            @else
            <x-slot name="title">Add New Device</x-slot>
            @endif
            <x-slot name="content">
                <div>
                    <div class="sm:col-span-6">
                        <label for="device_check_id" class="block text-sm font-medium text-gray-700"> Device Type </label>
                        <div class="mt-1">
                            <select name="device_check_id" wire:model.lazy="device_check_id"
                                class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Device</option>
                                @foreach (App\Models\DeviceCheck::orderBy('id', 'ASC')->get() as $data)
                                    <option value="{{ $data->id }}">{{ $data->main_device_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('section')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($device_check_id == 6)
                    <div class="mt-4">
                        <x-label for="other_device_name" value="{{ __('Type Device Name') }}" />
                        <input wire:model.lazy="other_device_name" class="block w-full mt-1" type="text" name="other_device_name"/>
                        @error('other_device_name') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    <div class="mt-4">
                        <x-label for="serialNo" value="{{ __('Serial No') }}" />
                        <input wire:model.lazy="serial_no" class="block w-full mt-1" type="text" name="serial_no" required autofocus autocomplete="serial_no" />
                        @error('serial_no') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="brand" value=" {{ __('Brand') }}" />
                        <input wire:model.lazy="brand" class="block w-full mt-1" type="text" name="brand" required />
                        @error('brand') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="model" value="{{ __('Model') }}" />
                        <input wire:model.lazy="model" class="block w-full mt-1" type="text" name="model" required />
                        @error('model') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>

                </div>
            </x-slot>
            <x-slot name="footer">
                @if ($isEditMode)
                <x-button wire:click="UpdateDevice">Update Device</x-button>
                @else
                <x-button wire:click="storeDevice">Store Device</x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
