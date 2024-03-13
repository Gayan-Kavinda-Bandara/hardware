<?php

namespace App\Livewire;

use App\Models\Device;
use Livewire\Component;
use Livewire\WithPagination;

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

    use WithPagination;

    public function showDeviceModal()
    {
        $this->reset();
        $this->showingDeviceModal=true;
    }

    public function render()
    {
        return view('livewire.device-management',[
            'devices' =>device::paginate(10)
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
