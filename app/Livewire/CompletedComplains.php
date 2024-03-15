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
                                    ->where('assDremarksState',"=", 2)
                                    ->where('techRemarksState',"=", 2)
                                    ->where('assITRemarksState',"=", 2)->paginate(7);
        return view('livewire.completed-complains')->layout('layouts.app')->with($response);
    }
}
