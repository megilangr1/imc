<?php

namespace App\Livewire\Pencairan;

use App\Helpers\MainHelper;
use App\Models\Skpd;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class BarjasNonKontrak extends Component
{
    use WithFileUploads;

    // Form State
    public $state = [];

    #[Locked]
    public $params = [
        'id_skpd' => null,
        'kegiatan' => null,
        'sub_kegiatan' => null,
        'pekerjaan' => null,
        'kode_rekening_belanja' => null,
        'nama_rekening_belanja' => null,
        'sumber_dana' => 'APBD',
        'nomor_sp_spk' => null,
        'lokasi' => null,
        'nomor_spm' => null,
        'tanggal_spm' => null,
        'nominal' => null,
        'nominal_text' => null,
        'nama_pihak_ketiga' => null,
        'kualifikasi' => null,
        'nomor_rekening' => null,
        'nama_bank' => null,
        'bpdp' => null,
        'keterangan' => null,
        'nip_pa_kpa' => null,
        'nama_pa_kpa' => null,
        'jabatan_pa_kpa' => null,
        'nip_ppk' => null,
        'nama_ppk' => null,
        'jabatan_ppk' => null,
    ];

    #[Locked]
    public $editData;
    // End Form State

    // Static Data 
    #[Locked]
    public $staticData = [
        'skpd' => [],
        'sumber_dana' => [],
    ];
    // End Static Data

    // Tom Select
    #[Locked]
    public $tomSelectData = [
        'skpd' => [
            'selectId' => 'skpd',
            'value' => '',
            'option' => null,
        ],
    ];
    // End Tom Select

    public function mount()
    {
        $this->state = $this->params;
        $this->getStaticData();
    }

    public function getStaticData()
    {
        try {
            $getSkpd = Skpd::orderBy('kode_skpd', 'ASC')->get();

            $this->staticData['skpd'] = $getSkpd;
            $this->staticData['sumber_dana'] = [
                'APBD',
                'Dana Transfer - DAK FISIK',
                'Dana Transfer - DAK NON FISIK',
                'Dana Transfer - DAU SG',
                'Dana Transfer - DBHCHT',
                'Dana Transfer - PAJAK ROKOK',
            ];
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.pencairan.barjas-non-kontrak');
    }

    public function actionForm()
    {
        dd($this->state);
    }

    // Event
    public function updatedState($value, $key)
    {
        if ($key === 'bpdp') {
            $this->resetErrorBag('state.bpdp');

            $this->validate([
                'state.bpdp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
            ], [], [
                'state.bpdp' => 'File Bukti Pembayaran / Daftar Penerima'
            ]);
        }
    }

    #[On('selectedSkpd')]
    public function selectedSkpd($value)
    {
        $tomSelectData = $this->tomSelectData;

        if ($value !== null) {
            $this->state['id_skpd'] = $value['uuid'];

            $tomSelectData['skpd']['selectId'] = 'skpd';
            $tomSelectData['skpd']['value'] = $value['uuid'];
            $tomSelectData['skpd']['option'] = null;
        }

        $this->dispatch('setTomSelect', $tomSelectData);
    }

    public function resetSelectedSkpd()
    {
        $this->state['id_skpd'] = null;
        $tomSelectData = $this->tomSelectData;
        $this->dispatch('setTomSelect', $tomSelectData);
    }
    // End Event
}
