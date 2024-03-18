<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Complain;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CompletedComplains extends Component
{
    use WithPagination;

    public $showingCompleteComplainModal = false;

    public $user_id;
    public $device_id;
    public $section_id;
    public $issue;
    public $assDremarks;
    public $assdreview;
    public $techRemarks;
    public $techreview;
    public $assITreview;
    public $assITRemarks;

    public $search = '';

    public function showCompleteComplain($id)
    {
        $this->assITreview = Complain::findOrFail($id);
        $this->user_id = $this->assITreview->user_id;
        $this->device_id = $this->assITreview->device_id;
        $this->section_id = $this->assITreview->section_id;
        $this->issue = $this->assITreview->issue;
        $this->assDremarks = $this->assITreview->assDremarks;
        $this->techRemarks = $this->assITreview->techRemarks;
        $this->assITRemarks = $this->assITreview->assITRemarks;
        $this->showingCompleteComplainModal = true;
    }

    public function render()
    {
        $response['complains'] = DB::table('complains')
                                    ->select('complains.id as id','device_id','user_id','complains.section_id as sid','issue','completedDate','name','main_device_name','model')
                                    ->join('users','users.id','=','complains.user_id')
                                    ->join('devices','devices.id','=','complains.device_id')
                                    ->join('device_checks','device_checks.id' ,'=','devices.device_check_id')
                                    ->where(function($a) {
                                        $a->where('name', 'like', '%'.$this->search.'%' )
                                         ->orwhere('main_device_name', 'like', '%'.$this->search.'%' )
                                         ->orwhere('model', 'like', '%'.$this->search.'%');
                                         })
                                    ->where('assDremarksState',"=", 2)
                                    ->where('techRemarksState',"=", 2)
                                    ->where('assITRemarksState',"=", 2)->paginate(7);
        return view('livewire.completed-complains')->layout('layouts.app')->with($response);
    }
}
