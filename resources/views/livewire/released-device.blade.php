<div>
    <div class="flex justify-end p-2 m-2 space-x-12">
        <input type="search" wire:click="gotoPage(1)" wire:model.lazy="search" placeholder="Search..." class="block px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5">
        <x-button class="bg-indigo-600" >Search</x-button>
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
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Released Date</th>
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
                                <td class="px-6 py-4 whitespace-nowrap">{{ $deviceConnect->release_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-2 m-2">{{ $deviceConnection->links() }}</div>
                </div>
            </div>
        </div>
    </div>

</div>
