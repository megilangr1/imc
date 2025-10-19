<?php

namespace App\Livewire\Pencairan;

use App\Helpers\MainHelper;
use App\Models\Pengajuan;
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
            $getSkpd = Skpd::where('tingkat', '=', 1)->orderBy('kode_skpd', 'ASC')->get();

            $this->staticData['kelompok_skpd'] = $getSkpd;
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        $data = new Pengajuan();

        if ($this->search != null) {
            $data = $data->where(function ($q) {
                $q->where('nama_jenis_pengajuan', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('nomor_spm', 'LIKE', '%' . $this->search . '%');
            });
        }

        $data = $data->orderBy($this->order_by, $this->order_type);

        $data = $data->paginate(10);

        return view('livewire.pencairan.main-index', [
            'data' => $data
        ]);
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

    public function actionPath($jenis, $uuid)
    {
        $route = false;

        switch ($jenis) {
            case 'ls-belanja-barang-dan-jasa-kontrak':
                $route = route('pencairan.barjas-kontrak.edit', ['uuid' => $uuid]);
                break;

            default:
                abort(404);
                break;
        }

        return $route;
    }

    // Action
    public function doEdit($jenis, $uuid)
    {
        $this->redirect($this->actionPath($jenis, $uuid), navigate: true);
    }

    public function doDetail($jenis, $uuid)
    {
        $this->redirect($this->actionPath($jenis, $uuid), navigate: true);
    }

    #[On('doDelete')]
    public function doDelete(String $uuid)
    {
        DB::beginTransaction();
        try {
            $data = Pengajuan::where('uuid', '=', $uuid)->firstOrFail();

            $delete = $data->delete();
            $dokumenDokumen = $data->dokumen()->delete();

            DB::commit();
            (new MainHelper)->doAlert($this, 'warning', 'Data Berhasil di-Hapus !');
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }


    public function dummy()
    {
        $this->redirect('/pencairan/formulir', navigate: true);
    }
}
