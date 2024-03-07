<x-app-layout>

    @if (Auth::User()->user_level == 1)
    <button href="/dashboard/userManagement" wire:navigate class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
        User Management
    </button>
    <button wire:navigate href="/dashboard/device" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Devices</button>
    <button wire:navigate href="/complainsMenu" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains</button>
    @elseif (Auth::User()->user_level == 2)
    <button wire:navigate href="/dashboard/device" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Devices</button>
    <button wire:navigate href="/complainsMenu" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains</button>
    @elseif (Auth::User()->user_level == 3)
    <button wire:navigate href="/complainsMenu" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains</button>
    <button wire:navigate href="/complainsAction" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains Action</button>
    @elseif (Auth::User()->user_level == 4)
    <button wire:navigate href="/complainsMenu" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains</button>
    <button wire:navigate href="/complainsAction" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains Action</button>
    @elseif (Auth::User()->user_level == 5)
    <button wire:navigate href="/complainsMenu" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains</button>
    <button wire:navigate href="/complainsAction" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains Action</button>
    <button wire:navigate href="/completedComplains" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Completed Complains</button>
    @elseif (Auth::User()->user_level == 6)
    <button wire:navigate href="/complainsMenu" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains</button>
    <button wire:navigate href="/complainsAction" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains Action</button>
    @elseif (Auth::User()->user_level == 7)
    <button wire:navigate href="/complainsMenu" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Complains</button>
    @endif

</x-app-layout>
