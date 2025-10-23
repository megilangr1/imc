<?php

namespace App\Livewire\Validasi;

use App\Helpers\MainHelper;
use App\Models\Pengajuan;
use App\Models\PengajuanDokumen;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class MainDetail extends Component
{
    use WithFileUploads;

    #[Locked]
    public ?Pengajuan $detailData;

    #[Locked]
    public $dokumenState = [];

    public $verifyState = [];
    public $hasilValidasi = null;
    public $catatanValidasi = null;
    // End Form State

    public function mount($uuid = null)
    {
        $this->getStaticData();

        if ($uuid != null) {
            $this->getDetail($uuid);

            if (isset($this->detailData)) {
                $this->setState();
            }
        }
    }

    public function getStaticData()
    {
        try {
            // 
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    public function getDetail($uuid)
    {
        try {
            $detailData = Pengajuan::with([
                'skpd',
                'dokumen'
            ])->where('uuid', '=', $uuid)
                ->whereIn('status', [3, 4, 5])->firstOrFail();
            $this->detailData = $detailData;
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function setState()
    {
        try {
            $dokumenState = (new MainHelper)->dokumenState[$this->detailData->kode_jenis_pengajuan];
            $verifyState = [];

            foreach ($this->detailData->dokumen as $key => $value) {
                if (isset($dokumenState[$value->kode_jenis_dokumen])) {
                    $dokumenState[$value->kode_jenis_dokumen]['uuid'] = $value->uuid;
                    $dokumenState[$value->kode_jenis_dokumen]['disk'] = $value->disk;
                    $dokumenState[$value->kode_jenis_dokumen]['folder'] = $value->folder;
                    $dokumenState[$value->kode_jenis_dokumen]['filename'] = $value->filename;
                    $dokumenState[$value->kode_jenis_dokumen]['path'] = $value->path;
                    $dokumenState[$value->kode_jenis_dokumen]['status_verifikasi'] = $value->status_verifikasi;
                    $dokumenState[$value->kode_jenis_dokumen]['status_validasi'] = $value->status_validasi;

                    $verifyState[$value->uuid] = $this->detailData->status === 3 ? null : ($value->status_validasi ? '1' : '0');
                }
            }

            $this->dokumenState = $dokumenState;
            $this->verifyState = $verifyState;
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.validasi.main-detail');
    }


    // Action
    public function actionForm()
    {
        $this->validate([
            'verifyState' => 'required|array',
            'verifyState.*' => 'required|boolean',
            'hasilValidasi' => 'required|boolean',
            'catatanValidasi' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $data = Pengajuan::where('uuid', '=', $this->detailData->uuid)->where('status', '=', 3)->firstOrFail();
            $dokumen = PengajuanDokumen::where('id_pengajuan', '=', $data->id)->whereIn('uuid', array_keys($this->verifyState))->get();

            if ($dokumen->count() !== count($this->verifyState)) throw new Error("Data Tidak Valid !");

            $update = $data->update([
                'status' => !!((int) $this->hasilValidasi) ? 5 : 4,
                'tanggal_validasi' => now(),
                'id_validator' => Auth::user()->id,
                'nama_validator' => Auth::user()->name,
                'catatan_validator' => $this->catatanValidasi,
            ]);

            foreach ($this->verifyState as $key => $value) {
                $updateDokumen = PengajuanDokumen::where('id_pengajuan', '=', $data->id)
                    ->where('uuid', '=', $key)
                    ->update([
                        'status_validasi' => (int) $value,
                        'id_validator' => Auth::user()->id,
                        'nama_validator' => Auth::user()->name,
                    ]);
            }

            DB::commit();
            (new MainHelper)->doAlert($this, 'success', 'Data Berhasil di-Buat !');
            return $this->redirect(route('validasi.detail', ['uuid' => $data->uuid]), navigate: true);

            dd($data, $dokumen, $dokumen->count());
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }
    // End Action

    // Dummy
    public function dummy()
    {
        dd($this->dokumenState, $this->verifyState);
    }
}
