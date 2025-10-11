<?php

namespace App\Livewire\Modal;

use App\Helpers\MainHelper;
use App\Models\Skpd;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DataSkpd extends Component
{
    public $search = "";
    public $modal = false;

    #[Locked]
    public $tingkat = 0;

    public function mount($tingkat = 0)
    {
        $this->tingkat = $tingkat;
    }

    public function render()
    {
        $data = new Skpd();

        if ($this->tingkat > 0) {
            $data = $data->where('tingkat', '=', $this->tingkat);
        }

        if ($this->search) {
            $data = $data->where('kode_skpd', 'LIKE', '%' . $this->search . '%')
                ->orWhere('nama_skpd', 'LIKE', '%' . $this->search . '%');
        }

        $data = $data->paginate(5);

        return view('livewire.modal.data-skpd', [
            'data' => $data,
        ]);
    }

    #[On('open-data-skpd-modal')]
    public function openModal()
    {
        $this->reset('search');
        $this->modal = true;
    }

    #[On('close-data-skpd-modal')]
    public function closeModal()
    {
        $this->reset('search');
        $this->modal = false;
    }

    public function selectSkpd($uuid)
    {
        try {
            $data = Skpd::where('uuid', '=', $uuid)->firstOrFail();

            $this->dispatch('selectedSkpd', $data->toArray());
            $this->closeModal();
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }
}
