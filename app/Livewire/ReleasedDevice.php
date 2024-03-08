<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ReleasedDevice extends Component
{
    use WithPagination;
    public function render()
    {
        $response['deviceConnection'] = DB::table('device_connets')->where('state', 2)->paginate(10);
        return view('livewire.released-device')->layout('layouts.app')->with($response);
    }

}
