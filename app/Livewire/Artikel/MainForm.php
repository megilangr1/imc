<?php

namespace App\Livewire\Artikel;

use App\Helpers\MainHelper;
use App\Models\Artikel;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class MainForm extends Component
{
    use WithFileUploads;

    public $state = [];

    #[Locked]
    public $params = [
        'judul' => null,
        'desc' => null,
        'content' => "",

        'foto' => null,
    ];

    #[Locked]
    public ?Artikel $editData;
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
            $editData = Artikel::where('uuid', '=', $uuid)->firstOrFail();
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
                'judul' => $this->editData->judul,
                'desc' => $this->editData->desc,
                'content' => $this->editData->content,
                'foto' => $this->editData->foto,
            ];


            $this->dispatch('fill-trix', [
                'hiddenInput' => 'content_input',
                'value' => $this->state['content'],
            ]);

            $this->dispatch('setTomSelect', $tomSelectData);
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        return view('livewire.artikel.main-form');
    }

    public function updatedState($value, $key)
    {
        if ($key === 'foto') {

            try {
                $rules = 'required|file|mimes:jpg,jpeg,png|max:5120';

                $this->validate([
                    'state.foto' => $rules
                ], [], [
                    'state.foto' => 'Foto Artikel'
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
            'state.judul' => 'required|string',
            'state.desc' => 'required|string',
            'state.content' => 'nullable|string',
            'state.foto' => 'required|file|mimes:jpg,jpeg,png|max:5120',
        ], [], [
            'state.judul' => 'Judul Artikel',
            'state.desc' => 'Deskripsi Singkat',
            'state.content' => 'Konten Artikel',
            'state.foto' => 'Foto Artikel',
        ]);

        DB::beginTransaction();
        try {

            $mimes = $this->state['foto']->getClientOriginalExtension();
            $disk = 'public-path';
            $folder = 'foto-artikel';
            $filename = date('mdYHis') . '-' . str()->slug($this->state['judul']) . '.' . $mimes;
            $path = $disk . '/' . $folder . '/' . $filename;

            $data = Artikel::firstOrCreate([
                'judul' => $this->state['judul'],
                'slug' => str()->slug($this->state['judul']),
                'desc' => $this->state['desc'],
                'content' => $this->state['content'],

                'disk' => $disk ?? null,
                'folder' => $folder ?? null,
                'filename' => $filename ?? null,
                'path' => $path ?? null,
            ]);

            $uploadFile = $this->state['foto']->storeAs($folder, $filename, $disk);

            DB::commit();
            (new MainHelper)->doAlert($this, 'success', 'Data Berhasil di-Buat !');
            return $this->redirect(route('artikel.index'), true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    public function doUpdate()
    {
        $this->validate([
            'state.judul' => 'required|string',
            'state.desc' => 'required|string',
            'state.content' => 'nullable|string',
            'state.foto' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ], [], [
            'state.judul' => 'Judul Artikel',
            'state.desc' => 'Deskripsi Singkat',
            'state.content' => 'Konten Artikel',
            'state.foto' => 'Foto Artikel',
        ]);

        DB::beginTransaction();
        try {
            $data = Artikel::where('uuid', '=', $this->editData->uuid)->firstOrFail();

            if ($this->state['foto'] != null) {
                $mimes = $this->state['foto']->getClientOriginalExtension();
                $disk = 'public-path';
                $folder = 'foto-artikel';
                $filename = date('mdYHis') . '-' . str()->slug($this->state['judul']) . '.' . $mimes;
                $path = $disk . '/' . $folder . '/' . $filename;
            }

            $update = $data->update([
                'judul' => $this->state['judul'],
                'slug' => str()->slug($this->state['judul']),
                'desc' => $this->state['desc'],
                'content' => $this->state['content'],

                'disk' => $disk ?? $data->disk,
                'folder' => $folder ?? $data->folder,
                'filename' => $filename ?? $data->filename,
                'path' => $path ?? $data->path,
            ]);

            if ($this->state['foto'] != null) $uploadFile = $this->state['foto']->storeAs($folder, $filename, $disk);

            DB::commit();
            (new MainHelper)->doAlert($this, 'info', 'Perubahan Data Berhasil di-Simpan !');
            return $this->redirect(route('artikel.index'), true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }


    // Event

    // End Event
}
