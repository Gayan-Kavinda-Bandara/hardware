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
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">view</th>

                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Status</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    @foreach ($complains as $complain)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $complain->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button class="bg-red-400 hover:bg-red-600" wire:click="showComplainOne({{ $complain->id }})">View</x-button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button class="bg-orange-400 hover:bg-orange-600" wire:click="showASSDReview({{ $complain->id }})">Action</x-button>
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
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">view</th>

                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">Status</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    @foreach ($complains as $complain)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $complain->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button class="bg-lime-400 hover:bg-lime-600" wire:click="showComplainTwo({{ $complain->id }})">View</x-button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button class="bg-green-400 hover:bg-green-600" wire:click="showASSDReview({{ $complain->id }})">Action</x-button>
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
                <div>
                    <x-label for="user_id" value="{{ __('User Id') }}" />
                    <input wire:model.lazy="user_id" class="block w-full mt-1" type="text" name="user_id" required autofocus autocomplete="user_id" disabled/>
                    @error('user_id') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="device_id" value="{{ __('Device ID') }}" />
                    <input wire:model.lazy="device_id" class="block w-full mt-1" type="text" name="device_id" required autofocus autocomplete="device_id" disabled/>
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

    {{--  For Assitant Director --}}
    <x-dialog-modal wire:model="showingASSDReview">
        <div>
            <x-slot name="title">Enter Assistant Director Remarks</x-slot>
            <x-slot name="content">
                <div>
                    <div class="mt-4">
                        <x-label for="assDremarks" value="{{ __('Remarks') }}" />
                        <input wire:model.lazy="assDremarks" class="block w-full mt-1" type="text" name="assDremarks" required autofocus autocomplete="assDremarks"/>
                        @error('assDremarks') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button wire:click="assdReSub">Submit</x-button>
            </x-slot>
        </div>
    </x-dialog-modal>

    {{--  For Technichian --}}
    <x-dialog-modal wire:model="showingPermentComplainModalTwo">
        <x-slot name="title">Sent Data</x-slot>
        <x-slot name="content">
            <div>
                <div>
                    <x-label for="user_id" value="{{ __('User Id') }}" />
                    <input wire:model.lazy="user_id" class="block w-full mt-1" type="text" name="user_id" required autofocus autocomplete="user_id" disabled/>
                    @error('user_id') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="device_id" value="{{ __('Device ID') }}" />
                    <input wire:model.lazy="device_id" class="block w-full mt-1" type="text" name="device_id" required autofocus autocomplete="device_id" disabled/>
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

                <div class="mt-4">
                    <x-label for="assDremarks" value="{{ __('Remarks') }}" />
                    <input wire:model.lazy="assDremarks" class="block w-full mt-1" type="text" name="assDremarks" required autofocus autocomplete="assDremarks"/>
                    @error('assDremarks') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-dialog-modal>
</div>
