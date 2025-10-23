<?php

namespace App\Livewire\Pencairan;

use App\Helpers\MainHelper;
use App\Models\Pengajuan;
use App\Models\PengajuanDokumen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class MainDetail extends Component
{
    use WithFileUploads;

    #[Locked]
    public ?Pengajuan $detailData;

    #[Locked]
    public $dokumenState = [];

    #[Locked]
    public $cetakResumeUrl;
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
            ])->where('uuid', '=', $uuid)->firstOrFail();
            $this->detailData = $detailData;
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function setState()
    {
        try {
            $dokumenState = (new MainHelper)->dokumenState[$this->detailData->kode_jenis_pengajuan];

            foreach ($this->detailData->dokumen as $key => $value) {
                if (isset($dokumenState[$value->kode_jenis_dokumen])) {
                    $dokumenState[$value->kode_jenis_dokumen]['uuid'] = $value->uuid;
                    $dokumenState[$value->kode_jenis_dokumen]['disk'] = $value->disk;
                    $dokumenState[$value->kode_jenis_dokumen]['folder'] = $value->folder;
                    $dokumenState[$value->kode_jenis_dokumen]['filename'] = $value->filename;
                    $dokumenState[$value->kode_jenis_dokumen]['path'] = $value->path;
                    $dokumenState[$value->kode_jenis_dokumen]['status_verifikasi'] = $value->status_verifikasi;
                    $dokumenState[$value->kode_jenis_dokumen]['status_validasi'] = $value->status_validasi;
                }
            }

            $this->dokumenState = $dokumenState;
            $this->cetakResumeUrl = $this->actionPath($this->detailData->kode_jenis_pengajuan, $this->detailData->uuid, 'cetak-resume');
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.pencairan.main-detail');
    }

    // Event
    public function actionPath($jenis, $uuid, $action)
    {
        $route = false;

        switch ($jenis) {
            case 'ls-belanja-barang-dan-jasa-kontrak':
                $route = route('pencairan.barjas-kontrak.' . $action, ['uuid' => $uuid]);
                break;
            case 'ls-belanja-barang-dan-jasa-non-kontrak':
                $route = route('pencairan.barjas-non-kontrak.' . $action, ['uuid' => $uuid]);
                break;
            case 'ls-hibah-dan-bansos':
                $route = route('pencairan.hibah-bansos.' . $action, ['uuid' => $uuid]);
                break;
            case 'tambah-uang':
                $route = route('pencairan.tambah-uang.' . $action, ['uuid' => $uuid]);
                break;
            case 'tunjangan-kinerja':
                $route = route('pencairan.tunjangan-kinerja.' . $action, ['uuid' => $uuid]);
                break;
            case 'gaji-jkk-jkm-bpjs':
                $route = route('pencairan.gaji-jkk-jkm-bpjs.' . $action, ['uuid' => $uuid]);
                break;
            case 'up-gu':
                $route = route('pencairan.up-gu.' . $action, ['uuid' => $uuid]);
                break;

            default:
                $route = false;
                break;
        }

        return $route;
    }

    // End Event

    // Action
    public function doEdit()
    {
        if (!$route = $this->actionPath($this->detailData->kode_jenis_pengajuan, $this->detailData->uuid, 'edit')) return (new MainHelper)->doAlert($this);
        $this->redirect($route, navigate: true);
    }
    // End Action

    // Upload Action
    public $modalUpload = false;

    public $activeState = null;
    public $fileState;

    public function openUploadModal($key)
    {
        $this->resetErrorBag('fileState');
        $this->reset('fileState', 'activeState');

        if (isset($this->dokumenState[$key])) {
            $this->activeState = $key;
        } else {
            (new MainHelper)->doAlert($this);
        }

        $this->modalUpload = true;
    }

    public function closeUploadModal()
    {
        $this->resetErrorBag('fileState');
        $this->reset('fileState', 'activeState');
        $this->modalUpload = false;
    }

    public function updatedFileState($value)
    {
        $rules = $this->dokumenState[$this->activeState]['rules'] ?? 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
        $this->validate(['fileState' => $rules], [], [
            'fileState' => 'File Dokumen'
        ]);
    }

    public function uploadFile()
    {
        if (!isset($this->dokumenState[$this->activeState])) {
            (new MainHelper)->doAlert($this);
            return;
        }

        $state = $this->dokumenState[$this->activeState];
        $this->validate(['fileState' => $state['rules']], [], [
            'fileState' => 'File Dokumen'
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::where('uuid', '=', $this->detailData->uuid)
                ->where('status', '=', 0)
                ->firstOrFail();
            $dokumen = PengajuanDokumen::where('id_pengajuan', '=', $pengajuan->id)->where('kode_jenis_dokumen', '=', $state['type'])->first();

            $mimes = $this->fileState->getClientOriginalExtension();
            $disk = 'private-path';
            $folder = $state['type'];
            $filename = date('mdYHis') . '-' . $state['type'] . '-' . $pengajuan->id . '-' . str()->slug($pengajuan->nomor_spm) . '.' . $mimes;
            $path = $disk . '/' . $folder . '/' . $filename;

            $data = [
                'uuid',
                'id_pengajuan' => $pengajuan->id,

                'kode_jenis_dokumen' => $state['type'],
                'nama_jenis_dokumen' => $state['title'],

                'disk' => $disk,
                'folder' => $folder,
                'filename' => $filename,
                'path' => $path,

                'status' => 0,

                'tanggal_verifikasi' => null,
                'id_verifikator' => null,
                'nama_verifikator' => null,
                'catatan_verifikator' => null,

                'tanggal_validasi' => null,
                'id_validator' => null,
                'nama_validator' => null,
                'catatan_validator' => null,
            ];

            if ($dokumen == null) {
                // Create
                $create = PengajuanDokumen::create($data);
            } else {
                // Update
                $update = $dokumen->update($data);
            }

            $uploadFile = $this->fileState->storeAs($folder, $filename, $disk);
            DB::commit();
            (new MainHelper)->doAlert($this, 'info', 'Berkas berhasil di-Upload !');
            $this->getDetail($pengajuan->uuid);
            $this->setState();
            $this->closeUploadModal();
        } catch (\Throwable $th) {
            DB::rollback();
            (new MainHelper)->doAlert($this);
        }
    }
    // End Upload Action

    // Ajukan Verifikasi
    #[On('doVerify')]
    public function doVerify()
    {
        DB::beginTransaction();
        try {
            $data = Pengajuan::where('uuid', '=', $this->detailData->uuid)->where('status', '=', 0)->firstOrFail();

            $update = $data->update([
                'status' => 1,
                'tanggal_pengajuan_verifikasi' => now(),
            ]);

            (new MainHelper)->doAlert($this, 'info', 'Verifikasi di-Ajukan !');
            $this->getDetail($data->uuid);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    #[On('doCancelVerify')]
    public function doCancelVerify()
    {
        DB::beginTransaction();
        try {
            $data = Pengajuan::where('uuid', '=', $this->detailData->uuid)->whereNotIn('status', [0, 5])->firstOrFail();

            $update = $data->update([
                'status' => 0,
                'tanggal_pengajuan_verifikasi' => null,
            ]);

            (new MainHelper)->doAlert($this, 'info', 'Verifikasi di-Ajukan !');
            $this->getDetail($data->uuid);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    #[On('doResetVerify')]
    public function doResetVerify()
    {
        DB::beginTransaction();
        try {
            $data = Pengajuan::where('uuid', '=', $this->detailData->uuid)->whereIn('status', [2, 4])->firstOrFail();

            $update = $data->update([
                'status' => 0,
                'tanggal_pengajuan_verifikasi' => null,
            ]);

            (new MainHelper)->doAlert($this, 'info', 'Verifikasi di-Ajukan !');
            $this->getDetail($data->uuid);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
            dd($th);
        }
    }
    // End Ajukan Verifikasi

    // Dummy
    public function dummy()
    {
        // $this->modalUpload = true;
        // dd($this->detailData->dokumen->toArray());
        dd($this->dokumenState);
    }
}
