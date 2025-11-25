<?php

namespace App\Livewire\Produk;

use App\Helpers\MainHelper;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class MainForm extends Component
{
    use WithFileUploads;

    public $state = [];

    #[Locked]
    public $params = [
        'id_kategori' => null,

        'nama_produk' => null,
        'sku' => null,
        'brand' => null,

        'harga' => null,
        'harga_text' => null,

        'stok' => null,
        'stok_text' => null,
        'satuan' => null,

        'deskripsi' => "null",

        'foto' => null,
    ];

    #[Locked]
    public ?Produk $editData;
    // End Form State

    // Static Data 
    #[Locked]
    public $staticData = [
        'kategori' => [],
    ];
    // End Static Data

    // Tom Select
    #[Locked]
    public $tomSelectData = [
        'kategori' => [
            'selectId' => 'kategori',
            'value' => '',
            'option' => null,
        ],
    ];
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
            $getKategori = Kategori::orderBy('nama_kategori', 'ASC')->get();

            $this->staticData['kategori'] = $getKategori;
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    public function getDetail($uuid)
    {
        try {
            $editData = Produk::with(['kategori'])->where('uuid', '=', $uuid)->firstOrFail();
            $this->editData = $editData;
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function setState()
    {
        if (isset($this->editData)) {
            $this->state = [
                'id_kategori' => $this->editData->kategori->uuid,
                'nama_produk' => $this->editData->nama_produk,
                'sku' => $this->editData->sku,
                'brand' => $this->editData->brand,
                'harga' => $this->editData->harga,
                'harga_text' => $this->editData->harga_text,
                'stok' => $this->editData->stok,
                'stok_text' => $this->editData->stok_text,
                'satuan' => $this->editData->satuan,
                'deskripsi' => $this->editData->deskripsi,
                'foto' => $this->editData->foto,
            ];

            // $this->dispatch('fill-trix', [
            //     'hiddenInput' => 'deskripsi_input',
            //     'value' => $this->state['deskripsi'],
            // ]);
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.produk.main-form');
    }

    public function updatedState($value, $key)
    {
        if ($key === 'foto') {

            try {
                $rules = 'required|file|mimes:jpg,jpeg,png|max:5120';

                $this->validate([
                    'state.foto' => $rules
                ], [], [
                    'state.foto' => 'Foto Produk'
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
            'state.id_kategori' => 'required|string|exists:kategoris,uuid',
            'state.nama_produk' => 'required|string',
            'state.sku' => 'nullable|string',
            'state.brand' => 'nullable|string',
            'state.harga' => 'nullable|numeric',
            'state.harga_text' => 'nullable|string',
            'state.stok' => 'nullable|numeric',
            'state.stok_text' => 'nullable|string',
            'state.satuan' => 'nullable|string',
            'state.deskripsi' => 'nullable|string',
            'state.foto' => 'required|file|mimes:jpg,jpeg,png|max:5120',
        ], [], [
            'state.id_kategori' => 'Kategori Produk',
            'state.nama_produk' => 'Nama Produk',
            'state.sku' => 'SKU',
            'state.brand' => 'Brand',
            'state.harga' => 'Harga Produk',
            'state.harga_text' => 'Harga Produk',
            'state.stok' => 'Stok Produk',
            'state.stok_text' => 'Stok Produk',
            'state.satuan' => 'Satuan Produk',
            'state.deskripsi' => 'Deskripsi Produk',
            'state.foto' => 'Foto Produk',
        ]);

        DB::beginTransaction();
        try {
            $kategori = Kategori::where('uuid', '=', $this->state['id_kategori'])->firstOrFail();

            $mimes = $this->state['foto']->getClientOriginalExtension();
            $disk = 'public-path';
            $folder = 'foto-produk';
            $filename = date('mdYHis') . '-' . str()->slug($this->state['nama_produk']) . '.' . $mimes;
            $path = $disk . '/' . $folder . '/' . $filename;

            $data = Produk::firstOrCreate([
                'id_kategori' => $kategori->id,
                'nama_produk' => $this->state['nama_produk'],
                'slug_produk' => str()->slug($this->state['nama_produk']),

                'sku' => $this->state['sku'],
                'brand' => $this->state['brand'],

                'harga' => $this->state['harga'],
                'stok' => $this->state['stok'],
                'satuan' => $this->state['satuan'],

                'deskripsi' => $this->state['deskripsi'],

                'disk' => $disk ?? null,
                'folder' => $folder ?? null,
                'filename' => $filename ?? null,
                'path' => $path ?? null,
            ]);

            $uploadFile = $this->state['foto']->storeAs($folder, $filename, $disk);

            DB::commit();
            (new MainHelper)->doAlert($this, 'success', 'Data Berhasil di-Buat !');
            return $this->redirect(route('produk.index'), true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    public function doUpdate()
    {
        $this->validate([
            'state.id_kategori' => 'required|string|exists:kategoris,uuid',
            'state.nama_produk' => 'required|string',
            'state.sku' => 'nullable|string',
            'state.brand' => 'nullable|string',
            'state.harga' => 'nullable|numeric',
            'state.harga_text' => 'nullable|string',
            'state.stok' => 'nullable|numeric',
            'state.stok_text' => 'nullable|string',
            'state.satuan' => 'nullable|string',
            'state.deskripsi' => 'nullable|string',
            'state.foto' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ], [], [
            'state.id_kategori' => 'Kategori Produk',
            'state.nama_produk' => 'Nama Produk',
            'state.sku' => 'SKU',
            'state.brand' => 'Brand',
            'state.harga' => 'Harga Produk',
            'state.harga_text' => 'Harga Produk',
            'state.stok' => 'Stok Produk',
            'state.stok_text' => 'Stok Produk',
            'state.satuan' => 'Satuan Produk',
            'state.deskripsi' => 'Deskripsi Produk',
            'state.foto' => 'Foto Produk',
        ]);

        DB::beginTransaction();
        try {
            $data = Produk::where('uuid', '=', $this->editData->uuid)->firstOrFail();
            $kategori = Kategori::where('uuid', '=', $this->state['id_kategori'])->firstOrFail();

            if ($this->state['foto'] != null) {
                $mimes = $this->state['foto']->getClientOriginalExtension();
                $disk = 'public-path';
                $folder = 'foto-produk';
                $filename = date('mdYHis') . '-' . str()->slug($this->state['nama_produk']) . '.' . $mimes;
                $path = $disk . '/' . $folder . '/' . $filename;
            }

            $update = $data->update([
                'id_kategori' => $kategori->id,
                'nama_produk' => $this->state['nama_produk'],
                'slug_produk' => str()->slug($this->state['nama_produk']),

                'sku' => $this->state['sku'],
                'brand' => $this->state['brand'],

                'harga' => $this->state['harga'],
                'stok' => $this->state['stok'],
                'satuan' => $this->state['satuan'],

                'deskripsi' => $this->state['deskripsi'],

                'disk' => $disk ?? $data->disk,
                'folder' => $folder ?? $data->folder,
                'filename' => $filename ?? $data->filename,
                'path' => $path ?? $data->path,
            ]);

            if ($this->state['foto'] != null) $uploadFile = $this->state['foto']->storeAs($folder, $filename, $disk);

            DB::commit();
            (new MainHelper)->doAlert($this, 'info', 'Perubahan Data Berhasil di-Simpan !');
            return $this->redirect(route('produk.index'), true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }


    // Event
    #[On('selectedKategori')]
    public function selectedKategori($value)
    {
        $tomSelectData = $this->tomSelectData;

        if ($value !== null) {
            $this->state['id_kategori'] = $value['uuid'];

            $tomSelectData['kategori']['selectId'] = 'kategori';
            $tomSelectData['kategori']['value'] = $value['uuid'];
            $tomSelectData['kategori']['option'] = null;
        }

        $this->dispatch('setTomSelect', $tomSelectData);
    }

    public function resetSelectedKategori()
    {
        $this->state['id_kategori'] = null;
        $tomSelectData = $this->tomSelectData;
        $this->dispatch('setTomSelect', $tomSelectData);
    }
    // End Event

    public function dummy()
    {
        // $this->dispatch('fill-trix', [
        //     'hiddenInput' => 'deskripsi_input',
        //     'value' => '',
        // ]);
    }
}
