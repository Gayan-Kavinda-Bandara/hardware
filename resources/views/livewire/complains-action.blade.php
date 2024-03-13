<div class="max-w-6xl mx-auto">
    {{--  For Assitant Director --}}
    @if (Auth::User()->user_level == 3)
    <div class="p-2 m-2">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                  <thead class="bg-orange-50 dark:bg-red-600 dark:text-orange-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Id</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Status</th>

                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">View and Action</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    @foreach ($complains as $complain)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $complain->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Ongoing</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button class="bg-red-400 hover:bg-red-600" wire:click="showComplainOne({{ $complain->id }})">View</x-button>
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
    {{--  For Technichian --}}
    @elseif (Auth::User()->user_level == 4)
    <div class="p-2 m-2">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                  <thead class="bg-orange-50 dark:bg-emerald-600 dark:text-orange-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Id</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Status</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">View and Action</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    @foreach ($complains as $complain)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $complain->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Ongoing</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button class="bg-lime-400 hover:bg-lime-600" wire:click="showComplainTwo({{ $complain->id }})">View</x-button>
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
    {{--  For Assistant IT Officer --}}
    @elseif (Auth::User()->user_level == 5)
    <div class="p-2 m-2">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                  <thead class="bg-cyan-50 dark:bg-cyan-600 dark:text-orange-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Id</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Status</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">View and Action</th>

                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    @foreach ($complains as $complain)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $complain->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Ongoing</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button class="bg-sky-400 hover:bg-sky-600" wire:click="showComplainThree({{ $complain->id }})">View</x-button>
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
    @endif

    {{--  For Assitant Director --}}
    <x-dialog-modal wire:model="showingPermentComplainModalOne">
        <x-slot name="title">Sent Data</x-slot>
        <x-slot name="content">
            <div>
                <div class="mt-4">
                    <div class="hidden">
                        {{
                            $test=DB::table("device_connets")
                            ->join("users","users.id","=","device_connets.user_id")
                            ->where("device_id","=",$device_id)
                            ->where("user_id","=",$user_id)->get()
                        }}
                    </div>
                    @foreach ($test as $data)
                    <x-label for="user_id" value="{{ __('User Name ') }}-{{ $data->name }}"/>
                    @endforeach
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
                    <x-label for="device_id" value="{{ __('Device Type and Model') }}" />
                    <select input wire:model.lazy="device_id" class="block w-full mt-1" type="text" name="device_id" required autofocus autocomplete="device_id" disabled>
                    <option value="">Select Device</option>

                    <div class="hidden">
                        {{
                            $test=DB::table("device_connets")
                            ->join("devices","devices.id","=","device_connets.device_id")
                            ->join("device_checks","device_checks.id","=","devices.device_check_id")
                            ->get()
                        }}
                    </div>

                    @foreach ($test as $data)
                    <option value="{{ $data->device_id }}">{{ $data->main_device_name }}-{{ $data->model }}</option>
                    @endforeach
                </select>
                    @error('device_id') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="issue" value=" {{ __('Issue') }}" />
                    <textarea wire:model.lazy="issue" name="issue" rows="3" cols="50" disabled>
                    </textarea>
                    @error('issue') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="assDremarks" value="{{ __('Remarks') }}" />
                    <textarea wire:model.lazy="assDremarks" name="assDremarks" rows="3" cols="50">
                    </textarea>
                    @error('assDremarks') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="assdReSub">Submit</x-button>
        </x-slot>
    </x-dialog-modal>

    {{--  For Technichian --}}
    <x-dialog-modal wire:model="showingPermentComplainModalTwo">
        <x-slot name="title">Sent Data</x-slot>
        <x-slot name="content">
            <div>
                <div class="mt-4">
                    <div class="hidden">
                        {{
                            $test=DB::table("device_connets")
                            ->join("users","users.id","=","device_connets.user_id")
                            ->where("device_id","=",$device_id)
                            ->where("user_id","=",$user_id)->get()
                        }}
                    </div>
                    @foreach ($test as $data)
                    <x-label for="user_id" value="{{ __('User Name ') }}-{{ $data->name }}"/>
                    @endforeach
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
                    <x-label for="device_id" value="{{ __('Device Type and Model') }}" />
                    <select input wire:model.lazy="device_id" class="block w-full mt-1" type="text" name="device_id" required autofocus autocomplete="device_id" disabled>
                    <option value="">Select Device</option>

                    <div class="hidden">
                        {{
                            $test=DB::table("device_connets")
                            ->join("devices","devices.id","=","device_connets.device_id")
                            ->join("device_checks","device_checks.id","=","devices.device_check_id")
                            ->get()
                        }}
                    </div>

                    @foreach ($test as $data)
                    <option value="{{ $data->device_id }}">{{ $data->main_device_name }}-{{ $data->model }}</option>
                    @endforeach
                </select>
                    @error('device_id') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="issue" value=" {{ __('Issue') }}" />
                    <textarea wire:model.lazy="issue" name="issue" rows="2" cols="50" disabled>
                    </textarea>
                    @error('issue') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="assDremarks" value="{{ __('Assistant Director Remarks') }}" />
                    <textarea wire:model.lazy="assDremarks" name="assDremarks" rows="2" cols="50" disabled>
                    </textarea>
                    @error('assDremarks') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="techRemarks" value="{{ __('Remarks') }}" />
                    <textarea wire:model.lazy="techRemarks" name="techRemarks" rows="3" cols="50">
                    </textarea>
                    @error('techRemarks') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="techReSub">Submit</x-button>
        </x-slot>
    </x-dialog-modal>

    {{--  For Assitant IT Officer --}}
    <x-dialog-modal wire:model="showingPermentComplainModalThree">
        <x-slot name="title">Sent Data</x-slot>
        <x-slot name="content">
            <div>
                <div class="mt-4">
                    <div class="hidden">
                        {{
                            $test=DB::table("device_connets")
                            ->join("users","users.id","=","device_connets.user_id")
                            ->where("device_id","=",$device_id)
                            ->where("user_id","=",$user_id)->get()
                        }}
                    </div>
                    @foreach ($test as $data)
                    <x-label for="user_id" value="{{ __('User Name ') }}-{{ $data->name }}"/>
                    @endforeach
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
                    <x-label for="device_id" value="{{ __('Device Type and Model') }}" />
                    <select input wire:model.lazy="device_id" class="block w-full mt-1" type="text" name="device_id" required autofocus autocomplete="device_id" disabled>
                    <option value="">Select Device</option>

                    <div class="hidden">
                        {{
                            $test=DB::table("device_connets")
                            ->join("devices","devices.id","=","device_connets.device_id")
                            ->join("device_checks","device_checks.id","=","devices.device_check_id")
                            ->get()
                        }}
                    </div>

                    @foreach ($test as $data)
                    <option value="{{ $data->device_id }}">{{ $data->main_device_name }}-{{ $data->model }}</option>
                    @endforeach
                </select>
                    @error('device_id') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="issue" value=" {{ __('Issue') }}" />
                    <textarea wire:model.lazy="issue" name="issue" rows="3" cols="50" disabled>
                    </textarea>
                    @error('issue') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="assDremarks" value="{{ __('Assistant Director Remarks') }}" />
                    <textarea wire:model.lazy="assDremarks" name="assDremarks" rows="3" cols="50" disabled>
                    </textarea>
                    @error('assDremarks') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="techRemarks" value="{{ __('Technichian Remarks') }}" />
                    <textarea wire:model.lazy="techRemarks" name="techRemarks" rows="3" cols="50" disabled>
                    </textarea>
                    @error('techRemarks') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-label for="assITRemarks" value="{{ __('Remarks') }}" />
                    <textarea wire:model.lazy="assITRemarks" name="assITRemarks" rows="3" cols="50">
                    </textarea>
                    @error('assITRemarks') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="assITReSub">Submit</x-button>
        </x-slot>
    </x-dialog-modal>

</div>
