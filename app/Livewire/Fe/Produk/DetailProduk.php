<?php

namespace App\Livewire\Fe\Produk;

use App\Helpers\MainHelper;
use App\Models\Produk;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

class DetailProduk extends Component
{
    #[Locked]
    public ?Produk $detailData;

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
            $this->detailData = Produk::where('slug_produk', '=', $slug)->firstOrFail();
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    #[Layout('layouts.frontend')]
    public function render()
    {
        return view('livewire.fe.produk.detail-produk');
    }
}
