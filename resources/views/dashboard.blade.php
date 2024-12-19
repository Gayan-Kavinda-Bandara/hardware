<x-app-layout>
  <div class="flex items-center justify-center h-screen bg-center bg-cover space-x-14" style="background-image: url('/images/wallpaper.jpg')">
    @if (Auth::User()->user_level == 1)
    <div class="text-center"> <!-- ⬅️ THIS DIV WILL BE CENTERED -->
        <h1 class="font-sans text-xl text-red-600">Admin View</h1>
        <button href="/dashboard/userManagement" wire:navigate class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">User Management</button>
    </div>
    @elseif (Auth::User()->user_level == 2)
    <div class="space-x-10 text-center">
        <h1 class="font-sans text-xl text-red-600">Inventory Member View</h1>
        <button wire:navigate href="/dashboard/device" class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Devices</button>
        <button wire:navigate href="/placeComplain" class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Place a Complain</button>
    </div>
    @elseif (Auth::User()->user_level == 3)
    <div class="text-center">
        <h1 class="font-sans text-xl text-red-600">Assistant Director View</h1>
        <button wire:navigate href="/complainsAction" class="justify-center px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Complains Action</button>
    </div>
    @elseif (Auth::User()->user_level == 4)
    <div class="text-center">
        <h1 class="font-sans text-xl text-red-600">Technichian View</h1>
        <button wire:navigate href="/complainsAction" class="justify-center px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Complains Action</button>
    </div>
    @elseif (Auth::User()->user_level == 5)
    <div class="text-center space-x-14">
        <h1 class="font-sans text-xl text-red-600">IT Officer View</h1>
        <button wire:navigate href="/complainsAction" class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Complains Action</button>
        <button wire:navigate href="/ongoingComplains" class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Ongoing Complains</button>
        <button wire:navigate href="/completedComplains" class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Completed Complains</button>
    </div>
    @elseif (Auth::User()->user_level == 6)
    <div class="text-center space-x-14">
        <h1 class="font-sans text-xl text-red-600">IT Director View</h1>
        <button wire:navigate href="/complainsAction" class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Complains Action</button>
        <button wire:navigate href="/ongoingComplains" class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Ongoing Complains</button>
        <button wire:navigate href="/completedComplains" class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Completed Complains</button>
    </div>
    @elseif (Auth::User()->user_level == 7)
    <div class="text-center">
        <h1 class="font-sans text-xl text-red-600">User View</h1>
        <button wire:navigate href="/placeComplain" class="px-4 py-2 mt-4 font-bold text-black scale-125 rounded bg-lime-300 hover:bg-lime-600">Place a Complain</button>
    </div>
    @endif
    </div>
</x-app-layout>
