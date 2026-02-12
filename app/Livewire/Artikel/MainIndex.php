<?php

namespace App\Livewire\Artikel;

use App\Helpers\MainHelper;
use App\Models\Artikel;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MainIndex extends Component
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

    #[Layout('layouts.master')]
    public function render()
    {
        $data = new Artikel();

        if ($this->search != null) {
            $data = $data->where(function ($q) {
                $q->where('judul', 'LIKE', '%' . $this->search . '%');
            });
        }

        $data = $data->orderBy($this->order_by, $this->order_type);

        $data = $data->paginate(10);
        // dd($data->toArray());

        return view('livewire.artikel.main-index', [
            'data' => $data
        ]);
    }

    // Event
    #[On('doDelete')]
    public function doDelete(String $uuid)
    {
        DB::beginTransaction();
        try {
            $data = Artikel::where('uuid', '=', $uuid)->firstOrFail();
            $delete = $data->delete();

            DB::commit();
            (new MainHelper)->doAlert($this, 'warning', 'Data Berhasil di-Hapus !');
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }
    // End Event

    // Filter Event
    #[On('setOrderBy')]
    public function setOrderBy($field)
    {
        if ($this->order_by === $field) {
            $this->order_type = $this->order_type === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->order_by = $field;
            $this->order_type = 'DESC';
        }
    }

    public function updatedSearch($value)
    {
        $this->resetPage();
    }
}
