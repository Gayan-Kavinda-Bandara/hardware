<?php

namespace App\Livewire;

use App\Models\Device;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DeviceManagement extends Component
{
    public $showingDeviceModal=false;

    public $serial_no;
    public $model;
    public $brand;
    public $employee_id;
    public $isEditMode = false;
    public $device;

    public $device_check_id;
    public $other_device_name;

    public $search = '';

    use WithPagination;

    public function showDeviceModal()
    {
        $this->reset();
        $this->showingDeviceModal=true;
    }

    public function render()
    {
        return view('livewire.device-management',[
            'devices'=>DB::table('devices')
            ->select('devices.id as id','main_device_name','devices.device_check_id as device_check_id','devices.other_device_name as other_device_name','serial_no','model','brand')
            ->Join("device_checks","device_checks.id","=","devices.device_check_id")
            ->where(function($a) {
                $a->where('main_device_name', 'like', '%'.$this->search.'%' )
                ->orWhere('model', 'like', '%'.$this->search.'%');
                })
            ->paginate(10)
        ])->layout('layouts.app');
    }

    public function storeDevice()
    {
        $this->validate([
            'device_check_id' => 'required',
            'model' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
        ]);

        Device::create([
        'device_check_id' => $this->device_check_id,
        'other_device_name' => $this->other_device_name,
        'serial_no' => $this->serial_no,
        'model' => $this->model,
        'brand' => $this->brand,
        ]);

        $this->reset();
    }

    public function showEditDeviceModal($id)
    {
        $this->device = Device::findOrFail($id);
        $this->device_check_id = $this->device->device_check_id;
        $this->other_device_name = $this->device->other_device_name;
        $this->serial_no = $this->device->serial_no;
        $this->model = $this->device->model;
        $this->brand = $this->device->brand;
        $this->showingDeviceModal = true;
        $this->isEditMode = true;
    }

    public function UpdateDevice()
    {
        $this->validate([
            'device_check_id' => 'required',
            'model' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
        ]);

        $this->device->update([
            'device_check_id' => $this->device_check_id,
            'other_device_name' => $this->other_device_name,
            'serial_no' => $this->serial_no,
            'model' => $this->model,
            'brand' => $this->brand,
        ]);

        $this->reset();
    }

    public function deleteDevice($id){

        try{
            $device=Device::findOrFail($id);
            $device->delete();
        }catch(\Illuminate\Database\QueryException $ex){

            if(true)
        {
            $this->dispatch('alert',[
                'title' => 'Attention!',
                'message' => 'This device is linked with user.',
                'type' => 'danger'
            ]);
        }
        }
        $this->reset();
    }
}
