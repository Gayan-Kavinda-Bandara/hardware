<div class="p-2 m-2">
    <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200">
              <thead class="bg-cyan-50 dark:bg-indigo-600 dark:text-orange-200">
                <tr>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Complain Id</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">User Id</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Device Id</th>
                  <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Section Id</th>
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
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->user_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->device_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->section_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->issue }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->assDremarks }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->techRemarks }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $complain->assITRemarks }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="p-2 m-2">Pagination</div>
          </div>
        </div>
      </div>
</div>
