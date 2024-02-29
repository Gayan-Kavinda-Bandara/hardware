<x-app-layout>

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
