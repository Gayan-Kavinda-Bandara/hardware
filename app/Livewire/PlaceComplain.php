<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Complain;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlaceComplain extends Component
{
    public $showingComplainModal = false;
    public $showingPermentComplainModal = false;

    public $user_id;
    public $device_id;
    public $section_id;
    public $issue;
    public $complain;

    public function showComplainModal ()
    {
        $this->reset();
        $this->showingComplainModal=true;
    }

    public function postComplain()
    {
        $this->validate([
            'device_id' => 'required',
            'issue' => 'required',
        ]);

        Complain::create([
        'user_id' => Auth::User()->id ,
        'device_id' => $this->device_id,
        'section_id' => Auth::User()->section_id,
        'issue' => $this->issue,
        ]);

        $this->reset();
    }

    public function showComplain($id)
    {
        $this->complain = Complain::findOrFail($id);
        $this->user_id = $this->complain->user_id;
        $this->device_id = $this->complain->device_id;
        $this->section_id = $this->complain->section_id;
        $this->issue = $this->complain->issue;
        $this->showingPermentComplainModal = true;
    }

    public function render()
    {
        $response['complains'] = DB::table('complains')->where('user_id',"=", Auth::User()->id)->get();
        return view('livewire.place-complain')->layout('layouts.app')->with($response);
    }
}
