<?php

namespace App\Livewire;

use App\Helpers\MainHelper;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dummy extends Component
{
    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.dummy');
    }

    public $publicData = [];

    public function dummy()
    {
        (new MainHelper)->doAlert($this);
    }
}
