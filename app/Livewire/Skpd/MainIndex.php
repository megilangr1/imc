<?php

namespace App\Livewire\Skpd;

use App\Helpers\MainHelper;
use App\Models\Skpd;
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
        'kode_skpd' => null,
        'nama_skpd' => null,
        'kode_kelompok_skpd' => null,
        'nama_kelompok_skpd' => null,
    ];

    #[Locked]
    public ?Skpd $editData;
    // End Form State

    // Static Data 
    #[Locked]
    public $staticData = [
        'kelompok_skpd' => []
    ];
    // End Static Data

    // Tom Select
    #[Locked]
    public $tomSelectData = [
        'kelompok_skpd' => [
            'selectId' => 'kelompok_skpd',
            'value' => '',
            'option' => null,
        ],
    ];
    // End Tom Select

    // Filter 
    #[Url(except: '')]
    public ?string $search = '';

    #[Url(except: '')]
    public $order_by = 'kode_skpd';

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
            $getSkpd = Skpd::where('tingkat', '=', 1)->orderBy('kode_skpd', 'ASC')->get();

            $this->staticData['kelompok_skpd'] = $getSkpd;
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        $data = new Skpd();

        if ($this->search != null) {
            $data = $data->where(function ($q) {
                $q->where('kode_skpd', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('nama_skpd', 'LIKE', '%' . $this->search . '%');
            });
        }

        $data = $data->orderBy($this->order_by, $this->order_type);

        $data = $data->paginate(10);

        return view('livewire.skpd.main-index', [
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
            $this->state['kode_skpd'] = $this->editData->kode_skpd;
            $this->state['nama_skpd'] = $this->editData->nama_skpd;

            if ($this->editData->tingkat > 1) {
                $this->state['kode_kelompok_skpd'] = $this->editData->kode_kelompok_skpd;
                $this->state['nama_kelompok_skpd'] = $this->editData->nama_kelompok_skpd;

                $tomSelectData['kelompok_skpd']['selectId'] = 'kelompok_skpd';
                $tomSelectData['kelompok_skpd']['value'] = $this->editData->kode_kelompok_skpd;
                // $tomSelectData['opd']['option'] = [
                //     'value' => $this->editData->opd->uuid,
                //     'text' => $this->editData->opd->nama_opd,
                // ];
            }
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
            'state.kode_skpd' => 'required|string|unique:skpds,kode_skpd',
            'state.nama_skpd' => 'required|string|unique:skpds,nama_skpd',
            'state.kode_kelompok_skpd' => 'nullable|string|exists:skpds,kode_skpd',
            'state.nama_kelompok_skpd' => 'nullable|string',
        ], [], [
            'state.kode_skpd' => 'Kode Satuan Kerja Perangkat Daerah (SKPD)',
            'state.nama_skpd' => 'Nama Satuan Kerja Perangkat Daerah (SKPD)',
            'state.kode_kelompok_skpd' => 'Kode Kelompok Satuan Kerja Perangkat Daerah (SKPD)',
            'state.nama_kelompok_skpd' => 'Nama Kelompok Satuan Kerja Perangkat Daerah (SKPD)',
        ]);

        DB::beginTransaction();
        try {
            $tingkat = 1;
            $kelompok = [
                'kode_kelompok_skpd' => $this->state['kode_skpd'],
                'nama_kelompok_skpd' => $this->state['nama_skpd'],
            ];

            if ($this->state['kode_kelompok_skpd'] != null) {
                $cekKelompok = Skpd::where('kode_skpd', '=', $this->state['kode_kelompok_skpd'])->firstOrFail();
                $kelompok['kode_kelompok_skpd'] = $cekKelompok->kode_skpd;
                $kelompok['nama_kelompok_skpd'] = $cekKelompok->nama_skpd;
                $tingkat = 2;
            }

            $data = Skpd::firstOrCreate([
                'kode_skpd' => $this->state['kode_skpd'],
                'nama_skpd' => $this->state['nama_skpd'],
                'kode_kelompok_skpd' => $kelompok['kode_kelompok_skpd'],
                'nama_kelompok_skpd' => $kelompok['nama_kelompok_skpd'],
                'tingkat' => $tingkat,
            ]);

            DB::commit();
            (new MainHelper)->doAlert($this, 'success', 'Data Berhasil di-Buat !');
            $this->showForm(false);

            if ($tingkat < 2) {
                $this->getStaticData();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    public function doEdit(String $uuid)
    {
        DB::beginTransaction();
        try {
            $this->editData = Skpd::where('uuid', '=', $uuid)->firstOrFail();
            $this->showForm(true, true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }


    public function doUpdate()
    {
        $this->validate([
            'state.kode_skpd' => 'required|string|unique:skpds,kode_skpd,' . $this->editData->id,
            'state.nama_skpd' => 'required|string|unique:skpds,nama_skpd,' . $this->editData->id,
            'state.kode_kelompok_skpd' => 'nullable|string|exists:skpds,kode_skpd',
            'state.nama_kelompok_skpd' => 'nullable|string',
        ], [], [
            'state.kode_skpd' => 'Kode Satuan Kerja Perangkat Daerah (SKPD)',
            'state.nama_skpd' => 'Nama Satuan Kerja Perangkat Daerah (SKPD)',
            'state.kode_kelompok_skpd' => 'Kode Kelompok Satuan Kerja Perangkat Daerah (SKPD)',
            'state.nama_kelompok_skpd' => 'Nama Kelompok Satuan Kerja Perangkat Daerah (SKPD)',
        ]);

        DB::beginTransaction();
        try {
            $data = Skpd::where('uuid', '=', $this->editData->uuid)->firstOrFail();

            $tingkat = 1;
            $kelompok = [
                'kode_kelompok_skpd' => $this->state['kode_skpd'],
                'nama_kelompok_skpd' => $this->state['nama_skpd'],
            ];

            if ($this->state['kode_kelompok_skpd'] != null) {
                $cekKelompok = Skpd::where('kode_skpd', '=', $this->state['kode_kelompok_skpd'])->firstOrFail();
                $kelompok['kode_kelompok_skpd'] = $cekKelompok->kode_skpd;
                $kelompok['nama_kelompok_skpd'] = $cekKelompok->nama_skpd;
                $tingkat = 2;
            }

            $update = $data->update([
                'kode_skpd' => $this->state['kode_skpd'],
                'nama_skpd' => $this->state['nama_skpd'],
                'kode_kelompok_skpd' => $kelompok['kode_kelompok_skpd'],
                'nama_kelompok_skpd' => $kelompok['nama_kelompok_skpd'],
                'tingkat' => $tingkat,
            ]);

            DB::commit();
            (new MainHelper)->doAlert($this, 'info', 'Perubahan Data Berhasil di-Simpan !');
            $this->showForm(false);

            if ($tingkat < 2) {
                $this->getStaticData();
            }
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
            $data = Skpd::where('uuid', '=', $uuid)->firstOrFail();
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
    #[On('selectedSkpd')]
    public function selectedSkpd($value)
    {
        $tomSelectData = $this->tomSelectData;

        if ($value !== null) {
            $this->state['kode_kelompok_skpd'] = $value['kode_skpd'];
            $this->state['nama_kelompok_skpd'] = $value['nama_skpd'];

            $tomSelectData['kelompok_skpd']['selectId'] = 'kelompok_skpd';
            $tomSelectData['kelompok_skpd']['value'] = $value['kode_skpd'];
            $tomSelectData['kelompok_skpd']['option'] = null;
        }

        $this->dispatch('setTomSelect', $tomSelectData);
    }

    public function resetSelectedSkpd()
    {
        $this->state['kode_kelompok_skpd'] = null;
        $this->state['nama_kelompok_skpd'] = null;
        $tomSelectData = $this->tomSelectData;
        $this->dispatch('setTomSelect', $tomSelectData);
    }

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
