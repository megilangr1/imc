<?php

namespace App\Livewire\Modal;

use App\Helpers\MainHelper;
use App\Models\Kategori;
use Livewire\Attributes\On;
use Livewire\Component;

class DataKategori extends Component
{
    public $search = "";
    public $modal = false;

    public function mount() {}

    public function render()
    {
        $data = new Kategori();

        if ($this->search) {
            $data = $data->where('nama_kategori', 'LIKE', '%' . $this->search . '%');
        }

        $data = $data->paginate(5);

        return view('livewire.modal.data-kategori', [
            'data' => $data,
        ]);
    }

    #[On('open-data-kategori-modal')]
    public function openModal()
    {
        $this->reset('search');
        $this->modal = true;
    }

    #[On('close-data-kategori-modal')]
    public function closeModal()
    {
        $this->reset('search');
        $this->modal = false;
    }

    public function selectKategori($uuid)
    {
        try {
            $data = Kategori::where('uuid', '=', $uuid)->firstOrFail();

            $this->dispatch('selectedKategori', $data->toArray());
            $this->closeModal();
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }
}
