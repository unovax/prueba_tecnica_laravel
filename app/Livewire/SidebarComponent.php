<?php

namespace App\Livewire;

use Livewire\Component;

class SidebarComponent extends Component
{
    public $show = true;
    public function render()
    {
        return view('livewire.sidebar-component');
    }
}
