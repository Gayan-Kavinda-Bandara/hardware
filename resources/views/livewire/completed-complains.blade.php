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
                  <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Ass.Director Remarks</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Technichian Remarks</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Ass.Officer It Remarks</th>

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
                            ->where("section_id","=",$complain->section_id)
                            ->where("device_id","=",$complain->device_id)
                            ->where("complains.id","=",$complain->id)->get()
                        }}
                    </div>
                    @foreach ($test as $data)
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $data->section_name }}
                    </td>
                    @endforeach
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->issue }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->assDremarks }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->techRemarks }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->assITRemarks }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="p-2 m-2">{{ $complains->links() }}</div>
          </div>
        </div>
      </div>
</div>
