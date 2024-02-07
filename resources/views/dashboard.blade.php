<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div> --}}

    @if (Auth::User()->user_level == 1)
    <button href="/dashboard/userManagement" wire:navigate class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
        User Management
    </button>
    <button wire:navigate href="/dashboard/device" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Devices</button>
    @elseif (Auth::User()->user_level == 2)
    <button wire:navigate href="/sendComplain" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Send Complain</button>
    @elseif (Auth::User()->user_level == 3)
    <button wire:navigate href="/dashboard/device" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Devices</button>
    @endif

</x-app-layout>
