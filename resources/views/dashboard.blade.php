<x-app-layout>
    <div class="flex flex-row items-center justify-center h-screen space-x-14 ">
    @if (Auth::User()->user_level == 1)
    <button href="/dashboard/userManagement" wire:navigate class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">User Management</button>
    <button wire:navigate href="/dashboard/device" class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Devices</button>
    <button wire:navigate href="/placeComplain" class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Place a Complain</button>
    @elseif (Auth::User()->user_level == 2)
    <button wire:navigate href="/dashboard/device" class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Devices</button>
    <button wire:navigate href="/placeComplain" class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Place a Complain</button>
    @elseif (Auth::User()->user_level == 3)
    <button wire:navigate href="/complainsAction" class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Complains Action</button>
    @elseif (Auth::User()->user_level == 4)
    <button wire:navigate href="/complainsAction" class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Complains Action</button>
    @elseif (Auth::User()->user_level == 5)
    <button wire:navigate href="/complainsAction" class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Complains Action</button>
    <button wire:navigate href="/completedComplains" class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Completed Complains</button>
    @elseif (Auth::User()->user_level == 6)
    <button wire:navigate href="/placeComplain" class="px-4 py-2 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Place a Complain</button>
    @endif
    </div>
</x-app-layout>
