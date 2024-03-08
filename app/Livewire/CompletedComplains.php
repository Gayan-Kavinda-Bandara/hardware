<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CompletedComplains extends Component
{
    use WithPagination;
    public function render()
    {
        $response['complains'] = DB::table('complains')
                                    ->where('assDremarksState',"=", 2)
                                    ->where('techRemarksState',"=", 2)
                                    ->where('assITRemarksState',"=", 2)->paginate(10);
        return view('livewire.completed-complains')->layout('layouts.app')->with($response);
    }
}
