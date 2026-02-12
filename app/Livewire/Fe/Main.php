<?php

namespace App\Livewire\Fe;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Main extends Component
{
    #[Layout('layouts.frontend')]
    public function render()
    {
        return view('livewire.fe.main');
    }
}
