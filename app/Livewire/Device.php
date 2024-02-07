<?php

namespace App\Livewire;

use Livewire\Component;

class Device extends Component
{
    public function render()
    {
        return view('livewire.device')->layout('layouts.app');
    }
}
