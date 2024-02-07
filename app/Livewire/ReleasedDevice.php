<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ReleasedDevice extends Component
{
    public function render()
    {
        $response['deviceConnection'] = DB::table('device_connets')->where('state', 2)->get();
        return view('livewire.released-device')->layout('layouts.app')->with($response);
    }

}
