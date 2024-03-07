<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CompletedComplains extends Component
{
    public function render()
    {
        $response['complains'] = DB::table('complains')
                                    ->where('assDremarksState',"=", 2)
                                    ->where('techRemarksState',"=", 2)
                                    ->where('assITRemarksState',"=", 2)->get();
        return view('livewire.completed-complains')->layout('layouts.app')->with($response);
    }
}
