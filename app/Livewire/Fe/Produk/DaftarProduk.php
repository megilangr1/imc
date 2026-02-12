<?php

namespace App\Livewire\Fe\Produk;

use App\Helpers\MainHelper;
use App\Models\Produk;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarProduk extends Component
{
    use WithPagination;

    // Static Data 
    #[Locked]
    public $staticData = [];
    // End Static Data

    // Tom Select
    #[Locked]
    public $tomSelectData = [];
    // End Tom Select


    // Filter 
    #[Url(except: '')]
    public ?string $search = '';

    #[Url(except: '')]
    public $order_by = 'created_at';

    #[Url(except: '')]
    public $order_type = 'DESC';
    // End Filter

    public function mount()
    {
        $this->getStaticData();
    }

    public function getStaticData()
    {
        try {
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    #[Layout('layouts.frontend')]
    public function render()
    {
        $data = new Produk();

        if ($this->search != null) {
            $data = $data->where(function ($q) {
                $q->where('nama_produk', 'LIKE', '%' . $this->search . '%');
            });
        }

        $data = $data->orderBy($this->order_by, $this->order_type);

        $data = $data->paginate(10);

        return view('livewire.fe.produk.daftar-produk', [
            'data' => $data
        ]);
    }
}
