<?php

namespace App\Livewire\Fe\Artikel;

use App\Helpers\MainHelper;
use App\Models\Artikel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarArtikel extends Component
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
        $data = new Artikel();

        if ($this->search != null) {
            $data = $data->where(function ($q) {
                $q->where('judul', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('desc', 'LIKE', '%' . $this->search . '%');
            });
        }

        $data = $data->orderBy($this->order_by, $this->order_type);

        $data = $data->paginate(10);

        return view('livewire.fe.artikel.daftar-artikel', [
            'data' => $data
        ]);
    }
}
