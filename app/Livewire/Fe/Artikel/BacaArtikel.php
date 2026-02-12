<?php

namespace App\Livewire\Fe\Artikel;

use App\Helpers\MainHelper;
use App\Models\Artikel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

class BacaArtikel extends Component
{
    #[Locked]
    public ?Artikel $detailData;

    public function mount($slug)
    {
        $this->getStaticData();
        $this->getDetail($slug);
    }

    public function getStaticData()
    {
        try {
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    public function getDetail($slug)
    {
        try {
            $this->detailData = Artikel::where('slug', '=', $slug)->firstOrFail();
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    #[Layout('layouts.frontend')]
    public function render()
    {
        return view('livewire.fe.artikel.baca-artikel');
    }
}
