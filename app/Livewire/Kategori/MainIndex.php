<?php

namespace App\Livewire\Kategori;

use App\Helpers\MainHelper;
use App\Models\Kategori;
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

    #[Locked]
    public $form = false;

    public $state = [];

    #[Locked]
    public $params = [
        'nama_kategori' => null,
    ];

    #[Locked]
    public ?Kategori $editData;
    // End Form State

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
        $this->state = $this->params;
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
        $data = new Kategori();

        if ($this->search != null) {
            $data = $data->where(function ($q) {
                $q->where('nama_kategori', 'LIKE', '%' . $this->search . '%');
            });
        }

        $data = $data->orderBy($this->order_by, $this->order_type);

        $data = $data->paginate(10);

        return view('livewire.kategori.main-index', [
            'data' => $data
        ]);
    }

    public function showForm(bool $open, $edit = false)
    {
        $this->form = $open;
        $this->reset('state');
        $this->resetErrorBag();
        $this->state = $this->params;

        $tomSelectData = $this->tomSelectData;

        if ($edit) {
            $this->state['nama_kategori'] = $this->editData['nama_kategori'];
        } else {
            $this->reset('editData');
        }

        $this->dispatch('setTomSelect', $tomSelectData);
    }

    public function actionForm()
    {
        if (isset($this->editData)) {
            $this->doUpdate();
        } else {
            $this->doCreate();
        }
    }

    public function doCreate()
    {
        $this->validate([
            'state.nama_kategori' => 'required|string|unique:kategoris,nama_kategori',
        ], [], [
            'state.nama_kategori' => 'Nama Kategori',
        ]);

        DB::beginTransaction();
        try {
            $data = Kategori::firstOrCreate([
                'nama_kategori' => $this->state['nama_kategori'],
                'slug_kategori' => str()->slug($this->state['nama_kategori']),
            ]);

            DB::commit();
            (new MainHelper)->doAlert($this, 'success', 'Data Berhasil di-Buat !');
            $this->showForm(false);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    public function doEdit(String $uuid)
    {
        DB::beginTransaction();
        try {
            $this->editData = Kategori::where('uuid', '=', $uuid)->firstOrFail();
            $this->showForm(true, true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
            dd($th);
        }
    }

    public function doUpdate()
    {
        $this->validate([
            'state.nama_kategori' => 'required|string|unique:kategoris,nama_kategori,' . $this->editData->id,
        ], [], [
            'state.nama_kategori' => 'Nama Kategori',
        ]);

        DB::beginTransaction();
        try {
            $data = Kategori::where('uuid', '=', $this->editData->uuid)->firstOrFail();

            $update = $data->update([
                'nama_kategori' => $this->state['nama_kategori'],
                'slug_kategori' => str()->slug($this->state['nama_kategori']),
            ]);

            DB::commit();
            (new MainHelper)->doAlert($this, 'info', 'Perubahan Data Berhasil di-Simpan !');
            $this->showForm(false);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    #[On('doDelete')]
    public function doDelete(String $uuid)
    {
        DB::beginTransaction();
        try {
            $data = Kategori::where('uuid', '=', $uuid)->firstOrFail();
            $delete = $data->delete();

            DB::commit();
            (new MainHelper)->doAlert($this, 'warning', 'Data Berhasil di-Hapus !');

            if ($this->form && $this->editData->uuid === $uuid) {
                $this->showForm(false, false);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    // Event

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
