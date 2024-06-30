<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;

class ToastComponent extends Component

{
    public $message = "";
    public $show = false;
    public $color = "#000";
    public function render()
    {
        return view('livewire.toast-component');
    }

    #[On('showToast')]
    public function showToas($message, $color) {
        $this->message = $message;
        $this->color = $color;
        $this->show = true;
    }
}
