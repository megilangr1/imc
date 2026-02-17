<?php

namespace App\Livewire\Fe;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Main extends Component
{
    #[Locked]
    public $linkWaMe = null;

    public function mount()
    {
        $phone = '6285800111055';

        $message = 'Halo, boleh tau informasi toko ?';

        $this->linkWaMe = 'https://wa.me/' . $phone . '?text=' . urlencode($message);
    }

    #[Layout('layouts.frontend')]
    public function render()
    {
        return view('livewire.fe.main');
    }
}
