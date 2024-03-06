<div class="max-w-6xl mx-auto">
    <div class="flex justify-end p-2 m-2">
        <x-button wire:click="showComplainModal">Post a Complain</x-button>
    </div>
    <x-dialog-modal wire:model="showingComplainModal">
        <x-slot name="title">Post a Complain</x-slot>
        <x-slot name="content">
            <div>

                <div class="mt-4">
                    <x-label for="device_id" value="{{ __('Device Id') }}" />
                    <select input wire:model.lazy="device_id" class="block w-full mt-1" type="text" name="device_id" required autofocus autocomplete="device_id">
                    <option value="">Select Device</option>

                    <div class="hidden">
                        {{
                            $test=DB::table("device_connets")
                            ->select("model","device_id","device_name")
                            ->join("devices","devices.id","=","device_connets.device_id")
                            ->where("user_id","=",Auth::User()->id)->get()
                        }}
                    </div>

                    @foreach ($test as $data)
                        <option value="{{ $data->device_id }}">{{ $data->device_name }}-{{ $data->model }}</option>
                    @endforeach
                </select>
                    @error('device_id') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="issue" value=" {{ __('Issue') }}" />
                    <input wire:model.lazy="issue" class="block w-full mt-1" type="text" name="issue" required />
                    @error('issue') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="postComplain">Submit</x-button>
        </x-slot>
    </x-dialog-modal>
    <div class="p-2 m-2">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                  <thead class="bg-blue-50 dark:bg-blue-600 dark:text-blue-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Id</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Status</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">view</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    @foreach ($complains as $complain)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $complain->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Ongoing</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button wire:click="showComplain({{ $complain->id }})">View</x-button>
                        </td>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="p-2 m-2">Pagination</div>
              </div>
            </div>
          </div>
    </div>
    <x-dialog-modal wire:model="showingPermentComplainModal">
        <x-slot name="title">Sent Data</x-slot>
        <x-slot name="content">
            <div>
                <div>
                    <x-label for="user_id" value="{{ __('User Id') }}" />
                    <input wire:model.lazy="user_id" class="block w-full mt-1" type="text" name="user_id" required autofocus autocomplete="user_id" disabled/>
                    @error('user_id') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="device_id" value="{{ __('Device Id') }}" />
                    <select input wire:model.lazy="device_id" class="block w-full mt-1" type="text" name="device_id" required autofocus autocomplete="device_id" disabled>
                    <option value="">Select Device</option>

                    <div class="hidden">
                        {{
                            $test=DB::table("device_connets")
                            ->join("devices","devices.id","=","device_connets.device_id")
                            ->where("user_id","=",Auth::User()->id)->get()
                        }}
                    </div>

                    @foreach ($test as $data)
                        <option value="{{ $data->device_id }}">{{ $data->device_name }}-{{ $data->model }}</option>
                    @endforeach
                </select>
                    @error('device_id') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="section" class="block text-sm font-medium text-gray-700"> Section </label>
                    <div class="mt-1">
                        <select name="section_id" wire:model.lazy="section_id"
                            class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" disabled>
                            <option value="">Select Section</option>
                            @foreach (App\Models\Section::orderBy('id', 'ASC')->get() as $data)
                                <option value="{{ $data->id }}">{{ $data->section_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('section')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-label for="issue" value=" {{ __('Issue') }}" />
                    <input wire:model.lazy="issue" class="block w-full mt-1" type="text" name="issue" required disabled />
                    @error('issue') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-dialog-modal>
</div>

