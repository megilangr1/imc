<?php

namespace App\Livewire\Pengguna;

use App\Helpers\MainHelper;
use App\Models\Skpd;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class MainIndex extends Component
{
    use WithPagination;

    #[Locked]
    public $form = false;

    public $state = [];

    #[Locked]
    public $params = [
        'id_skpd' => null,

        'name' => null,
        'nip' => null,
        'jabatan' => null,

        'email' => null,
        'password' => null,
        'password_confirmation' => null,

        'roles' => 'Administrator',
    ];

    #[Locked]
    public ?User $editData;
    // End Form State

    // Static Data 
    #[Locked]
    public $staticData = [
        'skpd' => [],
        'roles' => [],
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
        $this->state = $this->params;
        $this->getStaticData();
    }

    public function getStaticData()
    {
        try {
            $getSkpd = Skpd::orderBy('kode_skpd', 'ASC')->get();
            $getRoles = Role::where('name', '!=', 'MeGGi')->get();

            $this->staticData['skpd'] = $getSkpd;
            $this->staticData['roles'] = $getRoles;
        } catch (\Throwable $th) {
            (new MainHelper)->doAlert($this);
        }
    }

    #[Layout('layouts.master')]
    public function render()
    {
        $data = new User();
        $data = $data->with(['skpd', 'roles']);

        $data = $data->where('email', '!=', 'admin@mail.com');
        $data = $data->where('id', '!=', Auth::user()->id);

        if ($this->search != null) {
            $data = $data->where(function ($q) {
                $q->where('nip', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('jabatan', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%');
            });
        }

        $data = $data->orderBy($this->order_by, $this->order_type);

        $data = $data->paginate(10);

        return view('livewire.pengguna.main-index', [
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
            $this->state['id_skpd'] = $this->editData['id_skpd'];

            $this->state['name'] = $this->editData['name'];
            $this->state['nip'] = $this->editData['nip'];
            $this->state['jabatan'] = $this->editData['jabatan'];
            $this->state['email'] = $this->editData['email'];
            $this->state['roles'] = $this->editData->getRoleNames()[0] ?? 'Administrator';

            if ($this->editData->skpd != null) {
                $this->state['id_skpd'] = $this->editData->skpd->uuid;

                $tomSelectData['skpd']['selectId'] = 'skpd';
                $tomSelectData['skpd']['value'] = $this->editData->skpd->uuid;
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
            'state.id_skpd' => 'nullable|string|exists:skpds,uuid',
            'state.nip' => 'nullable|string',
            'state.name' => 'required|string',
            'state.jabatan' => 'nullable|string',

            'state.email' => 'required|string|email|unique:users,email',
            'state.password' => 'required|string|min:8|confirmed',
            'state.roles' => 'required|string|exists:roles,name',
        ], [], [
            'state.id_skpd' => 'Satuan Kerja Perangkat Daerah (SKPD)',
            'state.nip' => 'Nomor Induk Pegawai (NIP)',
            'state.name' => 'Nama Lengkap',
            'state.jabatan' => 'Jabatan',

            'state.email' => 'Email',
            'state.password' => 'Password',
            'state.roles' => 'Hak Akses Pengguna',
        ]);

        DB::beginTransaction();
        try {
            if ($this->state['id_skpd'] != null) {
                $skpd = Skpd::where('uuid', '=', $this->state['id_skpd'])->firstOrFail();
            }

            $data = User::firstOrCreate([
                'id_skpd' => $skpd->id ?? null,

                'name' => $this->state['name'],
                'nip' => $this->state['nip'],
                'jabatan' => $this->state['jabatan'],

                'email' => $this->state['email'],
                'password' => Hash::make($this->state['password']),
            ]);
            $data->syncRoles($this->state['roles']);

            DB::commit();
            (new MainHelper)->doAlert($this, 'success', 'Data Berhasil di-Buat !');
            $this->showForm(false);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }

    public function doEdit(String $uuid)
    {
        DB::beginTransaction();
        try {
            $this->editData = User::with(['skpd', 'roles'])->where('uuid', '=', $uuid)->firstOrFail();
            $this->showForm(true, true);
        } catch (\Throwable $th) {
            DB::rollBack();
            (new MainHelper)->doAlert($this);
        }
    }


    public function doUpdate()
    {
        $this->validate([
            'state.id_skpd' => 'nullable|string|exists:skpds,uuid',
            'state.nip' => 'nullable|string',
            'state.name' => 'required|string',
            'state.jabatan' => 'nullable|string',

            'state.email' => 'required|string|email|unique:users,email,' . $this->editData->id,
            'state.password' => 'nullable|string|min:8|confirmed',

            'state.roles' => 'required|string|exists:roles,name',
        ], [], [
            'state.id_skpd' => 'Satuan Kerja Perangkat Daerah (SKPD)',
            'state.nip' => 'Nomor Induk Pegawai (NIP)',
            'state.name' => 'Nama Lengkap',
            'state.jabatan' => 'Jabatan',

            'state.email' => 'Email',
            'state.password' => 'Password',
            'state.roles' => 'Hak Akses Pengguna',
        ]);

        DB::beginTransaction();
        try {
            $data = User::where('uuid', '=', $this->editData->uuid)->firstOrFail();
            $password = $this->state['password'] != null ? Hash::make($this->state['password']) : $data->password;

            if ($this->state['id_skpd'] != null) {
                $skpd = Skpd::where('uuid', '=', $this->state['id_skpd'])->firstOrFail();
            }

            $update = $data->update([
                'id_skpd' => $skpd->id ?? null,

                'name' => $this->state['name'],
                'nip' => $this->state['nip'],
                'jabatan' => $this->state['jabatan'],

                'email' => $this->state['email'],
                'password' => $password,
            ]);
            $data->syncRoles($this->state['roles']);

            DB::commit();
            (new MainHelper)->doAlert($this, 'info', 'Perubahan Data Berhasil di-Simpan !');
            $this->showForm(false);
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
            $data = User::where('uuid', '=', $uuid)->firstOrFail();
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
}
