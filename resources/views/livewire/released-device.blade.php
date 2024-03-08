<div class="p-2 m-2">
    <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">User Id</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Device Id</th>
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
                            <td class="px-6 py-4 whitespace-nowrap">{{ $deviceConnect->device_id }}</td>
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
