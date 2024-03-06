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
    public $showingASSDReview = false;

    public $user_id;
    public $device_id;
    public $section_id;
    public $issue;
    public $complain;
    public $assDremarks;
    public $assdreview;

    // For Assistant Director
    public function showComplainOne($id)
    {
        $this->complain = Complain::findOrFail($id);
        $this->user_id = $this->complain->user_id;
        $this->device_id = $this->complain->device_id;
        $this->section_id = $this->complain->section_id;
        $this->issue = $this->complain->issue;
        $this->showingPermentComplainModalOne = true;
    }

    // For Assistant Director
    public function showASSDReview($id)
    {
        $this->assdreview = Complain::findOrFail($id);
        $this->showingASSDReview = true;
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
        $this->complain = Complain::findOrFail($id);
        $this->user_id = $this->complain->user_id;
        $this->device_id = $this->complain->device_id;
        $this->section_id = $this->complain->section_id;
        $this->issue = $this->complain->issue;
        $this->assDremarks = $this->complain->assDremarks;
        $this->showingPermentComplainModalTwo = true;
    }

    // For Technichian
    // public function showASSDReview($id)
    // {
    //     $this->assdreview = Complain::findOrFail($id);
    //     $this->showingASSDReview = true;
    // }

    // // For Assistant Director
    // public function assdReSub ()
    // {
    //     $this->validate([
    //         'assDremarks' => 'required'
    //     ]);

    //     $this->assdreview->update([
    //         'assDremarks' => $this->assDremarks,
    //         'assDremarksState' => 2,
    //     ]);

    //     $this->reset();
    // }


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
                                    ->where('assDremarksState',"=", 2)->get();
            return view('livewire.complains-action')->layout('layouts.app')->with($response);
        }
    }
}
