<?php

namespace App\Livewire\Pencairan;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DaftarFormulir extends Component
{
    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.pencairan.daftar-formulir');
    }
}
