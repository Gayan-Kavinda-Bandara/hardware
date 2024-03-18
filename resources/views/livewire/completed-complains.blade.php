<div>
    <div class="flex justify-end p-2 m-2 space-x-10">
        <input type="search" wire:click="gotoPage(1)" wire:model.lazy="search" placeholder="Search..." class="block px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5">
        <x-button class="bg-indigo-600" >Search</x-button>
    </div>
    <div class="p-2 m-2">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                  <thead class="bg-cyan-50 dark:bg-indigo-600 dark:text-orange-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Complain Id</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">User Name</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Device Id</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Device Name</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Device Model</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Section</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Issue</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Completed Date</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Show all details</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    @foreach ($complains as $complain)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $complain->id }}</td>
                        <div class="hidden">
                            {{
                                $test=DB::table("complains")
                                ->join("users","users.id","=","complains.user_id")
                                ->where("user_id","=",$complain->user_id)
                                ->where("device_id","=",$complain->device_id)
                                ->where("complains.id","=",$complain->id)->get()
                            }}
                        </div>
                        @foreach ($test as $data)
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $data->name }}
                        </td>
                        @endforeach
                        <td class="px-6 py-4 whitespace-nowrap">{{ $complain->device_id }}</td>
                        <div class="hidden">
                            {{
                                $test=DB::table("device_connets")
                                ->join("devices","devices.id","=","device_connets.device_id")
                                ->join("device_checks","device_checks.id","=","devices.device_check_id")
                                ->where("device_id","=",$complain->device_id)
                                ->where("user_id","=",$complain->user_id)->get()
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

                        <div class="hidden">
                            {{
                                $test=DB::table("complains")
                                ->join("sections","sections.id","=","complains.section_id")
                                ->where("section_id","=",$complain->sid)
                                ->where("device_id","=",$complain->device_id)
                                ->where("complains.id","=",$complain->id)->get()
                            }}
                        </div>
                        @foreach ($test as $data)
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $data->section_name }}
                        </td>
                        @endforeach
                        <td class="px-6 py-4 whitespace-normal">{{ $complain->issue }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $complain->completedDate }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button class="bg-sky-400" wire:click="showCompleteComplain({{ $complain->id }})">View</x-button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="p-2 m-2">{{ $complains->links() }}</div>
              </div>
            </div>
          </div>
    </div>
    {{--  For Assitant IT Officer --}}
    <x-dialog-modal wire:model="showingCompleteComplainModal">
        <x-slot name="title">Complete data</x-slot>
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

                <div class="mt-4">
                    <div class="hidden">
                        {{
                            $test=DB::table("complains")
                            ->select("completedDate")
                            ->where("device_id","=",$device_id)
                            ->where("user_id","=",$user_id)->get()
                        }}
                    </div>
                    @foreach ($test as $data)
                    <x-label for="completedDate" value="{{ __('Completed Date') }}-{{ $data->completedDate }}"/>
                    @endforeach
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">

        </x-slot>
    </x-dialog-modal>

</div>
