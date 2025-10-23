<?php

namespace App\Livewire\Pencairan;

use App\Helpers\MainHelper;
use App\Models\Pengajuan;
use App\Models\PengajuanDokumen;
use App\Models\Skpd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public ?Pengajuan $editData;
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

    // User Info
    #[Locked]
    public $isAdmin = false;
    // End User Info

    public function mount($uuid = null)
    {
        $this->isAdmin = Auth::user()->is_admin;

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
            $getSkpd = new Skpd();
            if (!$this->isAdmin) $getSkpd = $getSkpd->where('id', '=', Auth::user()->id_skpd);
            $getSkpd = $getSkpd->orderBy('kode_skpd', 'ASC')->get();

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

    public function getDetail($uuid)
    {
        try {

            $editData = Pengajuan::with(['skpd'])->where('uuid', '=', $uuid)->where('status', '=', 0);
            if (!$this->isAdmin) $editData = $editData->where('id_creator', '=', Auth::id());
            $editData = $editData->firstOrFail();
            $this->editData = $editData;
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function setState()
    {
        if (isset($this->editData)) {
            $this->state = [
                'id_skpd' => $this->editData->skpd->uuid,
                'kegiatan' => $this->editData->kegiatan,
                'sub_kegiatan' => $this->editData->sub_kegiatan,
                'pekerjaan' => $this->editData->pekerjaan,
                'kode_rekening_belanja' => $this->editData->kode_rekening_belanja,
                'nama_rekening_belanja' => $this->editData->nama_rekening_belanja,
                'sumber_dana' => $this->editData->sumber_dana,
                'nomor_sp_spk' => $this->editData->nomor_sp_spk,
                'lokasi' => $this->editData->lokasi,
                'nomor_spm' => $this->editData->nomor_spm,
                'tanggal_spm' => $this->editData->tanggal_spm,
                'nominal' => $this->editData->nominal,
                'nominal_text' => number_format($this->editData->nominal, 0, ',', '.'),
                'nama_pihak_ketiga' => $this->editData->nama_pihak_ketiga,
                'kualifikasi' => $this->editData->kualifikasi,
                'nomor_rekening' => $this->editData->nomor_rekening,
                'nama_bank' => $this->editData->nama_bank,
                'bpdp' => null,
                'keterangan' => $this->editData->keterangan,
                'nip_pa_kpa' => $this->editData->nip_pa_kpa,
                'nama_pa_kpa' => $this->editData->nama_pa_kpa,
                'jabatan_pa_kpa' => $this->editData->jabatan_pa_kpa,
                'nip_ppk' => $this->editData->nip_ppk,
                'nama_ppk' => $this->editData->nama_ppk,
                'jabatan_ppk' => $this->editData->jabatan_ppk,
            ];
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.pencairan.barjas-non-kontrak');
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
            'state.id_skpd' => 'required|string|exists:skpds,uuid',
            'state.kegiatan' => 'required|string',
            'state.sub_kegiatan' => 'required|string',
            'state.pekerjaan' => 'required|string',
            'state.kode_rekening_belanja' => 'required|string',
            'state.nama_rekening_belanja' => 'required|string',
            'state.sumber_dana' => 'required|string',
            'state.nomor_sp_spk' => 'required|string',
            'state.lokasi' => 'required|string',
            'state.nomor_spm' => 'required|string',
            'state.tanggal_spm' => 'required|date',
            'state.nominal' => 'required|numeric',
            'state.nominal_text' => 'required|string',
            'state.nama_pihak_ketiga' => 'required|string',
            'state.kualifikasi' => 'required|string',
            'state.nomor_rekening' => 'required|string',
            'state.nama_bank' => 'required|string',
            'state.bpdp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'state.keterangan' => 'required|string',
            'state.nip_pa_kpa' => 'required|string',
            'state.nama_pa_kpa' => 'required|string',
            'state.jabatan_pa_kpa' => 'required|string',
            'state.nip_ppk' => 'required|string',
            'state.nama_ppk' => 'required|string',
            'state.jabatan_ppk' => 'required|string',
        ], [], [
            'state.id_skpd' => 'Satuan Kerja Perangkat Daerah (SKPD)',
            'state.kegiatan' => 'Kegiatan',
            'state.sub_kegiatan' => 'Sub Kegiatan',
            'state.pekerjaan' => 'Pekerjaan',
            'state.kode_rekening_belanja' => 'Kode Rekening Belanja',
            'state.nama_rekening_belanja' => 'Nama Rekening Belanja',
            'state.sumber_dana' => 'Sumber Dana',
            'state.nomor_sp_spk' => 'Nomor SP / SPK',
            'state.lokasi' => 'Lokasi',
            'state.nomor_spm' => 'Nomor SPM',
            'state.tanggal_spm' => 'Tanggal SPM',
            'state.nominal' => 'Nominal',
            'state.nominal_text' => 'Nominal',
            'state.nama_pihak_ketiga' => 'Nama Pihak Ketiga',
            'state.kualifikasi' => 'Kualifikasi',
            'state.nomor_rekening' => 'Nomor Rekening',
            'state.nama_bank' => 'Nama Bank',
            'state.bpdp' => 'File Bukti Pembayaran / Daftar Penerima',
            'state.keterangan' => 'Keterangan',
            'state.nip_pa_kpa' => 'NIP PA / KPA',
            'state.nama_pa_kpa' => 'Nama PA / KPA',
            'state.jabatan_pa_kpa' => 'Jabatan PA / KPA',
            'state.nip_ppk' => 'NIP PPK',
            'state.nama_ppk' => 'Nama PPK',
            'state.jabatan_ppk' => 'Jabatan PPK',
        ]);

        DB::beginTransaction();
        try {
            $skpd = Skpd::where('uuid', '=', $this->state['id_skpd'])->firstOrFail();

            if ($this->state['bpdp'] != null) {
                $mimes = $this->state['bpdp']->getClientOriginalExtension();
                $disk = 'private-path';
                $folder = 'bpdp';
                $filename = date('mdYHis') . '-' . 'bpdp' . '-' . str()->slug($this->state['nomor_spm']) . '.' . $mimes;
                $path = $disk . '/' . $folder . '/' . $filename;
            }

            $data = Pengajuan::firstOrCreate([
                'id_skpd' => $skpd->id,
                'kode_skpd' => $skpd->kode_skpd,
                'nama_skpd' => $skpd->nama_skpd,

                'kode_jenis_pengajuan' => 'ls-belanja-barang-dan-jasa-non-kontrak',
                'nama_jenis_pengajuan' => 'LS - Belanja Barang dan Jasa | Non Kontrak',

                'kegiatan' => $this->state['kegiatan'] ?? null,
                'sub_kegiatan' => $this->state['sub_kegiatan'] ?? null,
                'pekerjaan' => $this->state['pekerjaan'] ?? null,
                'kode_rekening_belanja' => $this->state['kode_rekening_belanja'] ?? null,
                'nama_rekening_belanja' => $this->state['nama_rekening_belanja'] ?? null,
                'sumber_dana' => $this->state['sumber_dana'] ?? null,
                'nomor_sp_spk' => $this->state['nomor_sp_spk'] ?? null,
                'lokasi' => $this->state['lokasi'] ?? null,
                'nomor_spm' => $this->state['nomor_spm'] ?? null,
                'tanggal_spm' => $this->state['tanggal_spm'] ?? null,
                'nominal' => (float) $this->state['nominal'] ?? null,
                'nama_pihak_ketiga' => $this->state['nama_pihak_ketiga'] ?? null,
                'kualifikasi' => $this->state['kualifikasi'] ?? null,
                'nomor_rekening' => $this->state['nomor_rekening'] ?? null,
                'nama_bank' => $this->state['nama_bank'] ?? null,

                'bpdp_filename' => $filename ?? null,
                'bpdp_disk' => $disk ?? null,
                'bpdp_folder' => $folder ?? null,
                'bpdp_path' => $path ?? null,

                'keterangan' => $this->state['keterangan'] ?? null,

                'nip_pa_kpa' => $this->state['nip_pa_kpa'] ?? null,
                'nama_pa_kpa' => $this->state['nama_pa_kpa'] ?? null,
                'jabatan_pa_kpa' => $this->state['jabatan_pa_kpa'] ?? null,

                'nip_ppk' => $this->state['nip_ppk'] ?? null,
                'nama_ppk' => $this->state['nama_ppk'] ?? null,
                'jabatan_ppk' => $this->state['jabatan_ppk'] ?? null,
            ]);

            $dokumenState = (new MainHelper)->dokumenState['ls-belanja-barang-dan-jasa-non-kontrak'];
            foreach ($dokumenState as $key => $value) {
                $insertDokumen = PengajuanDokumen::firstOrCreate([
                    'id_pengajuan' => $data->id,

                    'kode_jenis_dokumen' => $value['type'],
                    'nama_jenis_dokumen' => $value['title'],

                    'filename' => null,
                    'disk' => null,
                    'folder' => null,
                    'path' => null,

                    'status_verifikasi' => 0,
                    'id_verifikator' => null,
                    'nama_verifikator' => null,

                    'status_validasi' => 0,
                    'id_validator' => null,
                    'nama_validator' => null,
                ]);
            }

            if ($this->state['bpdp'] != null) {
                $uploadFile = $this->state['bpdp']->storeAs($folder, $filename, $disk);
            }

            DB::commit();
            (new MainHelper)->doAlert($this, 'success', 'Data Berhasil di-Buat !');
            return $this->redirect(route('pencairan.barjas-non-kontrak.detail', ['uuid' => $data->uuid]), navigate: true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    public function doUpdate()
    {
        $this->validate([
            'state.id_skpd' => 'required|string|exists:skpds,uuid',
            'state.kegiatan' => 'required|string',
            'state.sub_kegiatan' => 'required|string',
            'state.pekerjaan' => 'required|string',
            'state.kode_rekening_belanja' => 'required|string',
            'state.nama_rekening_belanja' => 'required|string',
            'state.sumber_dana' => 'required|string',
            'state.nomor_sp_spk' => 'required|string',
            'state.lokasi' => 'required|string',
            'state.nomor_spm' => 'required|string',
            'state.tanggal_spm' => 'required|date',
            'state.nominal' => 'required|numeric',
            'state.nominal_text' => 'required|string',
            'state.nama_pihak_ketiga' => 'required|string',
            'state.kualifikasi' => 'required|string',
            'state.nomor_rekening' => 'required|string',
            'state.nama_bank' => 'required|string',
            'state.bpdp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'state.keterangan' => 'required|string',
            'state.nip_pa_kpa' => 'required|string',
            'state.nama_pa_kpa' => 'required|string',
            'state.jabatan_pa_kpa' => 'required|string',
            'state.nip_ppk' => 'required|string',
            'state.nama_ppk' => 'required|string',
            'state.jabatan_ppk' => 'required|string',
        ], [], [
            'state.id_skpd' => 'Satuan Kerja Perangkat Daerah (SKPD)',
            'state.kegiatan' => 'Kegiatan',
            'state.sub_kegiatan' => 'Sub Kegiatan',
            'state.pekerjaan' => 'Pekerjaan',
            'state.kode_rekening_belanja' => 'Kode Rekening Belanja',
            'state.nama_rekening_belanja' => 'Nama Rekening Belanja',
            'state.sumber_dana' => 'Sumber Dana',
            'state.nomor_sp_spk' => 'Nomor SP / SPK',
            'state.lokasi' => 'Lokasi',
            'state.nomor_spm' => 'Nomor SPM',
            'state.tanggal_spm' => 'Tanggal SPM',
            'state.nominal' => 'Nominal',
            'state.nominal_text' => 'Nominal',
            'state.nama_pihak_ketiga' => 'Nama Pihak Ketiga',
            'state.kualifikasi' => 'Kualifikasi',
            'state.nomor_rekening' => 'Nomor Rekening',
            'state.nama_bank' => 'Nama Bank',
            'state.bpdp' => 'File Bukti Pembayaran / Daftar Penerima',
            'state.keterangan' => 'Keterangan',
            'state.nip_pa_kpa' => 'NIP PA / KPA',
            'state.nama_pa_kpa' => 'Nama PA / KPA',
            'state.jabatan_pa_kpa' => 'Jabatan PA / KPA',
            'state.nip_ppk' => 'NIP PPK',
            'state.nama_ppk' => 'Nama PPK',
            'state.jabatan_ppk' => 'Jabatan PPK',
        ]);

        DB::beginTransaction();
        try {
            $skpd = Skpd::where('uuid', '=', $this->state['id_skpd'])->firstOrFail();
            $data = Pengajuan::where('uuid', '=', $this->editData->uuid)->firstOrFail();

            if ($this->state['bpdp'] != null) {
                $mimes = $this->state['bpdp']->getClientOriginalExtension();
                $disk = 'private-path';
                $folder = 'bpdp';
                $filename = date('mdYHis') . '-' . 'bpdp' . '-' . str()->slug($this->state['nomor_spm']) . '.' . $mimes;
                $path = $disk . '/' . $folder . '/' . $filename;
            }

            $update = $data->update([
                'id_skpd' => $skpd->id,
                'kode_skpd' => $skpd->kode_skpd,
                'nama_skpd' => $skpd->nama_skpd,

                'kode_jenis_pengajuan' => 'ls-belanja-barang-dan-jasa-non-kontrak',
                'nama_jenis_pengajuan' => 'LS - Belanja Barang dan Jasa | Non Kontrak',

                'kegiatan' => $this->state['kegiatan'] ?? null,
                'sub_kegiatan' => $this->state['sub_kegiatan'] ?? null,
                'pekerjaan' => $this->state['pekerjaan'] ?? null,
                'kode_rekening_belanja' => $this->state['kode_rekening_belanja'] ?? null,
                'nama_rekening_belanja' => $this->state['nama_rekening_belanja'] ?? null,
                'sumber_dana' => $this->state['sumber_dana'] ?? null,
                'nomor_sp_spk' => $this->state['nomor_sp_spk'] ?? null,
                'lokasi' => $this->state['lokasi'] ?? null,
                'nomor_spm' => $this->state['nomor_spm'] ?? null,
                'tanggal_spm' => $this->state['tanggal_spm'] ?? null,
                'nominal' => (float) $this->state['nominal'] ?? null,
                'nama_pihak_ketiga' => $this->state['nama_pihak_ketiga'] ?? null,
                'kualifikasi' => $this->state['kualifikasi'] ?? null,
                'nomor_rekening' => $this->state['nomor_rekening'] ?? null,
                'nama_bank' => $this->state['nama_bank'] ?? null,

                'bpdp_filename' => $filename ?? $data->bpdp_filename,
                'bpdp_disk' => $disk ?? $data->bpdp_disk,
                'bpdp_folder' => $folder ?? $data->bpdp_folder,
                'bpdp_path' => $path ?? $data->bpdp_path,

                'keterangan' => $this->state['keterangan'] ?? null,

                'nip_pa_kpa' => $this->state['nip_pa_kpa'] ?? null,
                'nama_pa_kpa' => $this->state['nama_pa_kpa'] ?? null,
                'jabatan_pa_kpa' => $this->state['jabatan_pa_kpa'] ?? null,

                'nip_ppk' => $this->state['nip_ppk'] ?? null,
                'nama_ppk' => $this->state['nama_ppk'] ?? null,
                'jabatan_ppk' => $this->state['jabatan_ppk'] ?? null,
            ]);

            if ($this->state['bpdp'] != null) {
                $uploadFile = $this->state['bpdp']->storeAs($folder, $filename, $disk);
            }

            DB::commit();
            (new MainHelper)->doAlert($this, 'info', 'Perubahan Data Berhasil di-Simpan !');
            return $this->redirect(route('pencairan.barjas-non-kontrak.detail', ['uuid' => $data->uuid]), navigate: true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    // Event
    public function updatedState($value, $key)
    {
        if ($key === 'bpdp') {
            $this->resetErrorBag('state.bpdp');

            $this->validate([
                'state.bpdp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
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
