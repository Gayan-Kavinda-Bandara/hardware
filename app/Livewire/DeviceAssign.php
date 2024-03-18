<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DeviceConnet;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DeviceAssign extends Component
{
    public $showingDeviceAssignModal = false;
    public $showingDeviceReleaseModal = false;

    public $user_id;
    public $device_id;
    public $assign_date;
    public $state;
    public $release_date;
    public $device_connet;

    public $search = '';

    use WithPagination;

    public function showDeviceAssignModal()
    {
        $this->showingDeviceAssignModal = true;
    }

    public function assignDevice()
    {
        $this->validate([
            'user_id' => 'required|unique:device_connets,user_id,,,device_id,'.$this->device_id.'',
            'device_id' => 'required|unique:device_connets,device_id,,,user_id,'.$this->user_id.'',
            'assign_date' => 'required',
        ]);
        DeviceConnet::create([
            'user_id' => $this->user_id,
            'device_id' => $this->device_id,
            'assign_date' => $this->assign_date,
        ]);

        $this->reset();
    }

    public function showReleaseModal($Did,$Uid)
    {
        $this->showingDeviceReleaseModal = true;
        $iddata=DB::table('device_connets')->select('id')->where('user_id','=',$Uid)->where('device_id','=',$Did)->get();
        foreach($iddata as $item)
        {
            $id=$item->id;

        }
        $this->device_connet = DeviceConnet::findOrFail($id);
    }

    public function relaseDevice()
    {
        $this->validate([
            'state' => 'required',
            'release_date' => 'required',
        ]);

        $this->device_connet->update([
            'state' => $this->state,
            'release_date' => $this->release_date,
        ]);

        $this->reset();
    }

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
                                        ->where('state',"=", 1)
                                        ->paginate(10);
        return view('livewire.device-assign')->layout('layouts.app')->with($response);
    }
}
