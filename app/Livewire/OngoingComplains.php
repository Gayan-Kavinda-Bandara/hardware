<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class OngoingComplains extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $response['complains'] = DB::table('complains')
                                    ->select('complains.id as id','device_id','user_id','complains.section_id as sid','issue','completedDate',
                                    'name','main_device_name','model','postedDate','assDremarksState','techRemarksState','assITRemarksState')
                                    ->join('users','users.id','=','complains.user_id')
                                    ->join('devices','devices.id','=','complains.device_id')
                                    ->join('device_checks','device_checks.id' ,'=','devices.device_check_id')
                                    ->where(function($a) {
                                        $a->where('name', 'like', '%'.$this->search.'%' )
                                         ->orwhere('main_device_name', 'like', '%'.$this->search.'%' )
                                         ->orwhere('model', 'like', '%'.$this->search.'%');
                                         })
                                    ->where('assITRemarksState',"=", 1)->paginate(7);
        return view('livewire.ongoing-complains')->layout('layouts.app')->with($response);
    }
}
