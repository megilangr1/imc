<?php

namespace App\Livewire\Penjualan;

use App\Helpers\MainHelper;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

class MainForm extends Component
{
    public $state = [];

    #[Locked]
    public $params = [
        'nomor_nota' => null,
        'nama_pekerjaan' => null,
        'tempat_pekerjaan' => null,
        'tanggal_pekerjaan' => null,
        'pemilik_pekerjaan' => null,
        'tanda_terima_pekerjaan' => null,


        // Detail State
        'item' => null,
        'jumlah' => null,
        'jumlah_text' => null,
        'harga' => null,
        'harga_text' => null,

        'detail' => [],
    ];

    #[Locked]
    public ?Penjualan $editData;
    // End Form State

    // Static Data 
    #[Locked]
    public $staticData = [];
    // End Static Data

    // Tom Select
    #[Locked]
    public $tomSelectData = [];
    // End Tom Select

    public function mount($uuid = null)
    {
        $this->state = $this->params;
        $this->getStaticData();

        if ($uuid != null) {
            $this->getDetail($uuid);
            $this->setState();
        }
    }

    public function getStaticData()
    {
        try {
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    public function getDetail($uuid)
    {
        try {
            $editData = Penjualan::with(['detail'])->where('uuid', '=', $uuid)->firstOrFail();
            $this->editData = $editData;
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function setState()
    {
        if (isset($this->editData)) {
            $tomSelectData = $this->tomSelectData;

            $this->state = [
                'nomor_nota' => $this->editData->nomor_nota,
                'nama_pekerjaan' => $this->editData->nama_pekerjaan,
                'tempat_pekerjaan' => $this->editData->tempat_pekerjaan,
                'tanggal_pekerjaan' => $this->editData->tanggal_pekerjaan,
                'pemilik_pekerjaan' => $this->editData->pemilik_pekerjaan,
                'tanda_terima_pekerjaan' => $this->editData->tanda_terima_pekerjaan,

                // Detail State
                'item' => null,
                'jumlah' => null,
                'jumlah_text' => null,
                'harga' => null,
                'harga_text' => null,

                'detail' => [],
            ];

            foreach ($this->editData->detail as $key => $value) {
                $this->state['detail'][] = [
                    'item' => trim($value['item']),
                    'jumlah' => $value['jumlah'],
                    'harga' => $value['harga'],
                    'sub_total' => $value['jumlah'] * $value['harga'],
                ];
            }

            $this->dispatch('setTomSelect', $tomSelectData);
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.penjualan.main-form');
    }

    public function updatedState($value, $key)
    {
        if ($key === 'foto') {

            try {
                $rules = 'required|file|mimes:jpg,jpeg,png|max:5120';

                $this->validate([
                    'state.foto' => $rules
                ], [], [
                    'state.foto' => 'Foto Penjualan'
                ]);
            } catch (ValidationException $e) {
                // ❗ Reset file ketika gagal
                $this->state['foto'] = null;

                // lempar error lagi supaya alert tetap muncul
                throw $e;
            }
        }
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
            'state.nomor_nota' => 'required|string',
            'state.nama_pekerjaan' => 'required|string',
            'state.tempat_pekerjaan' => 'required|string',
            'state.tanggal_pekerjaan' => 'required|date',
            'state.pemilik_pekerjaan' => 'required|string',
            'state.tanda_terima_pekerjaan' => 'required|string',
        ], [], [
            'state.nomor_nota' => 'Nomor Nota / Kuitansi',
            'state.nama_pekerjaan' => 'Nama Pekerjaan',
            'state.tempat_pekerjaan' => 'Tempat Pekerjaan',
            'state.tanggal_pekerjaan' => 'Tanggal Pekerjaan',
            'state.pemilik_pekerjaan' => 'Pemilik Pekerjaan',
            'state.tanda_terima_pekerjaan' => 'TTD / Tanda Terima',
        ]);

        DB::beginTransaction();
        try {
            $data = Penjualan::firstOrCreate([
                'nomor_nota' => $this->state['nomor_nota'],
                'nama_pekerjaan' => $this->state['nama_pekerjaan'],
                'tempat_pekerjaan' => $this->state['tempat_pekerjaan'],
                'tanggal_pekerjaan' => $this->state['tanggal_pekerjaan'],
                'pemilik_pekerjaan' => $this->state['pemilik_pekerjaan'],
                'tanda_terima_pekerjaan' => $this->state['tanda_terima_pekerjaan'],
                'total_nominal' => array_sum(array_column($this->state['detail'], 'sub_total')),
            ]);

            foreach ($this->state['detail'] as $key => $value) {
                $detail = PenjualanDetail::create([
                    'id_penjualan' => $data->id,
                    'item' => $value['item'],
                    'jumlah' => $value['jumlah'],
                    'harga' => $value['harga'],
                ]);
            }

            DB::commit();
            (new MainHelper)->doAlert($this, 'success', 'Data Berhasil di-Buat !');
            return $this->redirect(route('penjualan.index'), true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
            dd($th);
        }
    }

    public function doUpdate()
    {
        $this->validate([
            'state.nomor_nota' => 'required|string',
            'state.nama_pekerjaan' => 'required|string',
            'state.tempat_pekerjaan' => 'required|string',
            'state.tanggal_pekerjaan' => 'required|date',
            'state.pemilik_pekerjaan' => 'required|string',
            'state.tanda_terima_pekerjaan' => 'required|string',
        ], [], [
            'state.nomor_nota' => 'Nomor Nota / Kuitansi',
            'state.nama_pekerjaan' => 'Nama Pekerjaan',
            'state.tempat_pekerjaan' => 'Tempat Pekerjaan',
            'state.tanggal_pekerjaan' => 'Tanggal Pekerjaan',
            'state.pemilik_pekerjaan' => 'Pemilik Pekerjaan',
            'state.tanda_terima_pekerjaan' => 'TTD / Tanda Terima',
        ]);

        DB::beginTransaction();
        try {
            $data = Penjualan::where('uuid', '=', $this->editData->uuid)->firstOrFail();

            $update = $data->update([
                'nomor_nota' => $this->state['nomor_nota'],
                'nama_pekerjaan' => $this->state['nama_pekerjaan'],
                'tempat_pekerjaan' => $this->state['tempat_pekerjaan'],
                'tanggal_pekerjaan' => $this->state['tanggal_pekerjaan'],
                'pemilik_pekerjaan' => $this->state['pemilik_pekerjaan'],
                'tanda_terima_pekerjaan' => $this->state['tanda_terima_pekerjaan'],
                'total_nominal' => array_sum(array_column($this->state['detail'], 'sub_total')),
            ]);

            $deleteDetail = $data->detail()->delete();
            foreach ($this->state['detail'] as $key => $value) {
                $detail = PenjualanDetail::create([
                    'id_penjualan' => $data->id,
                    'item' => $value['item'],
                    'jumlah' => $value['jumlah'],
                    'harga' => $value['harga'],
                ]);
            }

            DB::commit();
            (new MainHelper)->doAlert($this, 'info', 'Perubahan Data Berhasil di-Simpan !');
            return $this->redirect(route('penjualan.index'), true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }


    // Event
    public function tambahItem()
    {
        $this->resetErrorBag();

        $this->validate([
            'state.item' => 'required|string',
            'state.jumlah' => 'required|min:1|numeric',
            'state.harga' => 'required|min:0|numeric',
        ], [], [
            'state.item' => 'Nama Item',
            'state.jumlah' => 'Jumlah',
            'state.harga' => 'Harga',
        ]);

        try {
            $this->state['detail'][] = [
                'item' => trim($this->state['item']),
                'jumlah' => $this->state['jumlah'],
                'harga' => $this->state['harga'],
                'sub_total' => $this->state['jumlah'] * $this->state['harga'],
            ];

            $this->state['item'] = null;
            $this->state['jumlah'] = null;
            $this->state['jumlah_text'] = null;
            $this->state['harga'] = null;
            $this->state['harga_text'] = null;
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    public function hapusItem($key)
    {
        try {
            if (isset($this->state['detail'][$key])) unset($this->state['detail'][$key]);
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }
    // End Event 
}
