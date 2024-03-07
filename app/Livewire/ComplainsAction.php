<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Complain;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ComplainsAction extends Component
{
    public $showingPermentComplainModalOne = false;
    public $showingPermentComplainModalTwo = false;
    public $showingPermentComplainModalThree = false;
    public $showingASSDReview = false;
    public $showingTECHReview = false;
    public $showingASSITReview = false;

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

    // For Assistant Director
    public function showComplainOne($id)
    {
        $this->assdreview = Complain::findOrFail($id);
        $this->user_id = $this->assdreview->user_id;
        $this->device_id = $this->assdreview->device_id;
        $this->section_id = $this->assdreview->section_id;
        $this->issue = $this->assdreview->issue;
        $this->assDremarks = $this->assdreview->assDremarks;
        $this->showingPermentComplainModalOne = true;
    }

    // For Assistant Director
    public function assdReSub ()
    {
        $this->validate([
            'assDremarks' => 'required'
        ]);

        $this->assdreview->update([
            'assDremarks' => $this->assDremarks,
            'assDremarksState' => 2,
        ]);

        $this->reset();
    }

    // For Technichian
    public function showComplainTwo($id)
    {
        $this->techreview = Complain::findOrFail($id);
        $this->user_id = $this->techreview->user_id;
        $this->device_id = $this->techreview->device_id;
        $this->section_id = $this->techreview->section_id;
        $this->issue = $this->techreview->issue;
        $this->assDremarks = $this->techreview->assDremarks;
        $this->showingPermentComplainModalTwo = true;
    }

    // For Technichian
    public function techReSub ()
    {
        $this->validate([
            'techRemarks' => 'required'
        ]);

        $this->techreview->update([
            'techRemarks' => $this->techRemarks,
            'techRemarksState' => 2,
            'techMemberID' => Auth::User()->id
        ]);

        $this->reset();
    }

    //For Assistant IT Officer
    public function showComplainThree($id)
    {
        $this->assITreview = Complain::findOrFail($id);
        $this->user_id = $this->assITreview->user_id;
        $this->device_id = $this->assITreview->device_id;
        $this->section_id = $this->assITreview->section_id;
        $this->issue = $this->assITreview->issue;
        $this->assDremarks = $this->assITreview->assDremarks;
        $this->techRemarks = $this->assITreview->techRemarks;
        $this->showingPermentComplainModalThree = true;
    }

    // For Assistant IT Officer
    public function assITReSub ()
    {
        $this->validate([
            'assITRemarks' => 'required'
        ]);

        $this->assITreview->update([
            'assITRemarks' => $this->assITRemarks,
            'assITRemarksState' => 2,
        ]);

        $this->reset();
    }


    public function render()
    {
        if(Auth::user()->user_level == 3) // For Assistant Director
        {
            $response['complains'] = DB::table('complains')
                                    ->where('assDremarksState',"=", 1)
                                    ->where('section_id','=',Auth::User()->section_id)->get();
            return view('livewire.complains-action')->layout('layouts.app')->with($response);
        }
        else if(Auth::user()->user_level == 4) // For Technichian
        {
            $response['complains'] = DB::table('complains')
                                    ->where('assDremarksState',"=", 2)
                                    ->where('techRemarksState',"=", 1)->get();
            return view('livewire.complains-action')->layout('layouts.app')->with($response);
        }
        else if(Auth::user()->user_level == 5) // For Assistant IT Officer
        {
            $response['complains'] = DB::table('complains')
                                    ->where('assDremarksState',"=", 2)
                                    ->where('techRemarksState',"=", 2)
                                    ->where('assITRemarksState',"=", 1)->get();
            return view('livewire.complains-action')->layout('layouts.app')->with($response);
        }
    }
}
