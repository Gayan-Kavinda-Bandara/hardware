<?php

namespace App\Livewire;

use Livewire\Component;

class ComplainsMenu extends Component
{
    public function render()
    {
        return view('livewire.complains-menu')->layout('layouts.app');
    }
}
