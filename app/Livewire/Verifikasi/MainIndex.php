<?php

namespace App\Livewire\Verifikasi;

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
        'kelompok_skpd' => [],
        'status' => [
            // 0 => 'Draft / Belum di-Ajukan Verifikasi',
            1 => 'Menunggu Untuk di-Verifikasi',
            2 => 'Verifikasi di-Tolak',
            3 => 'Terverfikasi, Menunggu Untuk di-Validasi',
            4 => 'Validasi di-Tolak',
            5 => 'Data Terverifikasi dan Tervalidasi',
        ],
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

    public $status;
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

        if ($this->status != null) {
            $data = $data->where('status', '=', $this->status);
        }

        $data = $data->where('status', '!=', 0);
        $data = $data->orderBy($this->order_by, $this->order_type);
        $data = $data->paginate(10);

        return view('livewire.verifikasi.main-index', [
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

    public function updatedStatus($value)
    {
        $this->resetPage();
    }

    public function actionPath($jenis, $uuid, $action)
    {
        $route = false;

        switch ($jenis) {
            case 'ls-belanja-barang-dan-jasa-kontrak':
                $route = route('verifikasi.barjas-kontrak.' . $action, ['uuid' => $uuid]);
                break;
            case 'ls-belanja-barang-dan-jasa-non-kontrak':
                $route = route('verifikasi.barjas-non-kontrak.' . $action, ['uuid' => $uuid]);
                break;
            case 'ls-hibah-dan-bansos':
                $route = route('verifikasi.hibah-bansos.' . $action, ['uuid' => $uuid]);
                break;
            case 'tambah-uang':
                $route = route('verifikasi.tambah-uang.' . $action, ['uuid' => $uuid]);
                break;
            case 'tunjangan-kinerja':
                $route = route('verifikasi.tunjangan-kinerja.' . $action, ['uuid' => $uuid]);
                break;
            case 'gaji-jkk-jkm-bpjs':
                $route = route('verifikasi.gaji-jkk-jkm-bpjs.' . $action, ['uuid' => $uuid]);
                break;
            case 'up-gu':
                $route = route('verifikasi.up-gu.' . $action, ['uuid' => $uuid]);
                break;

            default:
                $route = false;
                break;
        }

        return $route;
    }

    // Action
    public function doDetail($jenis, $uuid)
    {
        if (!$route = $this->actionPath($jenis, $uuid, 'detail')) return (new MainHelper)->doAlert($this);
        $this->redirect($route, navigate: true);
    }


    public function dummy()
    {
        $this->redirect('/pencairan/formulir', navigate: true);
    }
}
