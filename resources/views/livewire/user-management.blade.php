<div class="max-w-6xl mx-auto ">
    <div class="flex justify-end p-2 m-2 ">
        <x-button class="bg-black" wire:click="showRegModal">Register User</x-button>
    </div>
    <div class="p-2 m-2">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    Id</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    Section</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    EmployeeId</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    Designation</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    Contact No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    User Level</th>
                                <th scope="col" class="relative px-6 py-3">Edit/Delete</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr></tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    @foreach (App\Models\Section::where('id', '=', $user->section_id)->get() as $data)
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $data->section_name }}</td>
                                    @endforeach
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->employeeId }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->designation }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->contNo }}</td>
                                    @foreach (App\Models\UserLevel::where('id', '=', $user->user_level)->get() as $data)
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $data->user_level_name }}</td>
                                    @endforeach
                                    <td class="px-6 py-4 text-sm text-right">
                                        <div class="flex space-x-2">
                                            <div>
                                                <x-button
                                                wire:click="showEditUserModal({{ $user->id }})">Edit</x-button>
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
                                                <x-button class="bg-red-400 hover:bg-red-600" wire:click="deleteUser({{ $user->id }})">Delete</x-button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-2 m-2">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <x-dialog-modal wire:model="showingRegModal">
            @if ($isEditMode)
                <x-slot name="title">Update User</x-slot>
            @else
                <x-slot name="title">Register New User</x-slot>
            @endif
            <x-slot name="content">
                <div>
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <input wire:model.lazy="name" class="block w-full mt-1" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        @error('name')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <input wire:model.lazy="email" class="block w-full mt-1" type="email" name="email"
                            :value="old('email')" required autocomplete="email" />
                        @error('email')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-6">
                        <label for="section" class="block text-sm font-medium text-gray-700"> Section </label>
                        <div class="mt-1">
                            <select name="section" wire:model.lazy="section"
                                class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
                        <x-label for="designation" value="Designation" />
                        <input wire:model.lazy="designation" class="block w-full mt-1" type="text" name="designation"
                            :value="old('designation')" required />
                        @error('designation')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="employeeId" value="Employee Id" />
                        <input wire:model.lazy="employeeId" class="block w-full mt-1" type="text" name="employeeId"
                            :value="old('employeeId')" required />
                        @error('employeeId')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="contNo" value="Contact No" />
                        <input wire:model.lazy="contNo" class="block w-full mt-1" type="text" name="contNo"
                            :value="old('contNo')" required />
                        @error('contNo')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-6">
                        <label for="user_level" class="block text-sm font-medium text-gray-700"> User Level </label>
                        <div class="mt-1">
                            <select name="user_level_id" wire:model.lazy="user_level_id"
                                class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select User Level</option>
                                @foreach (App\Models\UserLevel::orderBy('id', 'ASC')->get() as $data)
                                    <option value="{{ $data->id }}">{{ $data->user_level_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('user_level_id')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($isEditMode == false)
                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <input wire:model.lazy="password" class="block w-full mt-1" type="password"
                                name="password" required autocomplete="new-password" />
                            @error('password')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <input wire:model.lazy="password_confirmation" class="block w-full mt-1" type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                            @error('password_confirmation')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>
            </x-slot>
            <x-slot name="footer">
                @if ($isEditMode)
                    <x-button wire:click="updateUser">update User</x-button>
                @else
                    <x-button wire:click="storeUser">Register</x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
