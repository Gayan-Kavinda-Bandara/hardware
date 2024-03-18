<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ReleasedDevice extends Component
{
    public $search = '';
    use WithPagination;
    public function render()
    {
        $response['deviceConnection'] = DB::table('device_connets')
                                        ->select('device_connets.id as cid','device_id','user_id','assign_date','release_date','state')
                                        ->join('users','users.id','=','device_connets.user_id')
                                        ->join('devices','devices.id','=','device_connets.device_id')
                                        ->join('device_checks','device_checks.id' ,'=','devices.device_check_id')
                                        ->where(function($a) {
                                           $a->where('name', 'like', '%'.$this->search.'%' )
                                            ->orwhere('main_device_name', 'like', '%'.$this->search.'%' )
                                            ->orwhere('model', 'like', '%'.$this->search.'%');
                                            })
                                        ->where('state', 2)
                                        ->paginate(10);
        return view('livewire.released-device')->layout('layouts.app')->with($response);
    }

}
