<div class="flex flex-col gap-3">
    <x-main.page-header title="Data Satuan Kerja Perangkat Daerah (SKPD)">
        <button type="button" class="btn btn-neutral btn-sm" wire:click="showForm(true)"
            @if ($form) disabled @endif>Tambah Data</button>
    </x-main.page-header>

    <div class="card border border-slate-300 bg-base-100 w-full {{ $form ? 'block' : 'hidden' }}">
        <div class="card-body p-0">
            <div class="card-title px-5 py-3 border-b border-b-slate-300 text-sm flex items-center justify-between">
                <div class="flex-auto">
                    Formulir {{ $editData ? 'Ubah' : 'Tambah' }} Satuan Kerja Perangkat Daerah (SKPD)
                </div>

                <button type="button" class="btn bg-red-500 text-white btn-xs" wire:click="showForm(false)">
                    Tutup Formulir
                </button>
            </div>
            <form wire:submit="actionForm">
                <div class="w-full grid grid-cols-6 px-6 pb-2 gap-3">
                    <div class="col-span-6 md:col-span-6">
                        <div class="flex flex-col sm:flex-row justify-between gap-1 mb-2">
                            <span
                                class="flex-auto block text-sm font-medium {{ $errors->has('state.kode_kelompok_skpd') ? 'text-red-500' : '' }}"
                                wire:click="$dispatchTo('modal.data-skpd', 'open-data-skpd-modal')">
                                Kelompok SKPD :
                            </span>
                            <div class="ms-auto">
                                <div class="flex gap-x-1">
                                    @if ($state['kode_kelompok_skpd'] != null)
                                        <span class="badge badge-xs badge-error cursor-pointer text-white"
                                            wire:click="resetSelectedSkpd">
                                            <svg class="shrink-0 size-2" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="lucide lucide-rotate-ccw">
                                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                                <path d="M3 3v5h5" />
                                            </svg>

                                            Reset Pilihan
                                        </span>
                                    @endif
                                    <span class="badge badge-xs badge-success cursor-pointer text-white"
                                        wire:click="$dispatchTo('modal.data-skpd', 'open-data-skpd-modal')">
                                        <svg class="shrink-0 size-2" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-sheet-icon lucide-sheet">
                                            <rect width="18" height="18" x="3" y="3" rx="2"
                                                ry="2" />
                                            <line x1="3" x2="21" y1="9" y2="9" />
                                            <line x1="3" x2="21" y1="15" y2="15" />
                                            <line x1="9" x2="9" y1="9" y2="21" />
                                            <line x1="15" x2="15" y1="9" y2="21" />
                                        </svg>

                                        Daftar Data
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div wire:ignore>
                            <select wire:model="state.kode_kelompok_skpd" id="kelompok_skpd" name="kelompok_skpd"
                                class="w-full @error('state.kode_kelompok_skpd') select-error @enderror"
                                aria-describedby="kelompok_skpd-helper">
                                <option value="">Pilih Kelompok SKPD</option>
                                @foreach ($staticData['kelompok_skpd'] as $item)
                                    <option value="{{ $item->kode_skpd }}">
                                        {{ $item->kode_skpd }} - {{ $item->nama_skpd }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('state.kode_kelompok_skpd')
                            <p class="text-xs text-red-600 mt-1" id="kelompok_skpd-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-2">
                        <label for="kode_skpd"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.kode_skpd') ? 'text-red-500' : '' }}">
                            Kode SKPD :
                            <span class="text-red-500 text-xs">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.kode_skpd" id="kode_skpd" name="kode_skpd"
                                class="w-full input @error('state.kode_skpd') input-error @enderror"
                                aria-describedby="kode_skpd-helper" placeholder="Masukan Kode SKPD..." required
                                autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.kode_skpd') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12">
                                    </line>
                                    <line x1="12" x2="12.01" y1="16" y2="16">
                                    </line>
                                </svg>
                            </div>
                        </div>
                        @error('state.kode_skpd')
                            <p class="text-xs text-red-600 mt-1" id="kode_skpd-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-4">
                        <label for="nama_skpd"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.nama_skpd') ? 'text-red-500' : '' }}">
                            Nama SKPD :
                            <span class="text-red-500 text-xs">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.nama_skpd" id="nama_skpd" name="nama_skpd"
                                class="w-full input @error('state.nama_skpd') input-error @enderror"
                                aria-describedby="nama_skpd-helper" placeholder="Masukan Nama SKPD..." required
                                autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.nama_skpd') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
                                <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12">
                                    </line>
                                    <line x1="12" x2="12.01" y1="16" y2="16">
                                    </line>
                                </svg>
                            </div>
                        </div>
                        @error('state.nama_skpd')
                            <p class="text-xs text-red-600 mt-1" id="nama_skpd-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6">
                        <hr class="border-t-1 border-t-slate-300">
                    </div>

                    <div class="col-span-6 md:col-span-2 lg:col-span-1">
                        <button type="submit" class="btn btn-neutral w-full btn-sm">
                            {{ isset($editData) ? 'Simpan Data' : 'Buat Data' }}
                        </button>
                    </div>
                    <div class="col-span-6 md:col-span-2 lg:col-span-1">
                        <button type="{{ $editData ? 'button' : 'reset' }}" class="btn btn-error w-full btn-sm"
                            @isset($editData) wire:click="showForm(false)" @endisset>
                            {{ isset($editData) ? 'Batalkan' : 'Reset Input' }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="card-actions text-xs font-semibold text-slate-600 bg-slate-200 rounded-b-lg px-5 py-2">
                Formulir {{ $editData ? 'Ubah' : 'Tambah' }} Satuan Kerja Perangkat Daerah (SKPD)
            </div>
        </div>
    </div>

    <div class="w-full grid grid-cols-12">
        <div class="relative w-full col-span-12 md:col-span-8 lg:col-span-4">
            <label class="sr-only" for="filter-search-data-skpd">Cari Data :</label>
            <input type="text" name="filter-search-data-skpd" id="filter-search-data-skpd"
                wire:model.live.debounce.500ms="search"
                class="py-2 px-3 ps-9 block w-full border border-gray-300 text-sm rounded outline-none"
                placeholder="Masukan Keyword Untuk Melakukan Pencarian...">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto border rounded-lg border-slate-300">
        <table class="table table-sm table-pin-rows table-pin-cols">
            <thead>
                <tr>
                    <th class="text-center" width="8%">
                        No.
                    </th>
                    <td>
                        <x-table.th label="Kode SKPD" field="kode_skpd" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Nama SKPD" field="nama_skpd" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Kelompok" field="nama_kelompok_skpd" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Pembuat" field="nama_creator" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <th class="text-center" width="10%">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <th class="text-center bg-slate-200">{{ $loop->iteration }}.</th>
                        <td>{{ $item->kode_skpd }}</td>
                        <td>{{ $item->nama_skpd }}</td>
                        <td>{{ $item->nama_kelompok_skpd }}</td>
                        <td>{{ $item->nama_creator }}</td>
                        <th class="text-center">
                            <button type="button" class="btn btn-xs btn-neutral w-full font-normal tracking-wider"
                                popovertarget="popover-{{ $loop->iteration }}"
                                style="anchor-name:--anchor-{{ $loop->iteration }}">
                                Aksi
                            </button>
                            <div class="dropdown dropdown-end menu w-auto rounded-box bg-base-100 border border-slate-300 shadow-lg text-xs flex flex-col gap-1 px-4"
                                popover id="popover-{{ $loop->iteration }}"
                                style="position-anchor:--anchor-{{ $loop->iteration }}">
                                <h5 class="text-center">Aksi Data</h5>
                                <hr class="border-t-1 border-t-slate-300 my-1">
                                <button type="button"
                                    class="btn btn-xs btn-outline w-full font-normal tracking-wider"
                                    popovertarget="popover-{{ $loop->iteration }}"
                                    wire:click="doEdit('{{ $item->uuid }}')">
                                    Edit Data
                                </button>
                                <button type="button" popovertarget="popover-{{ $loop->iteration }}"
                                    class="btn btn-xs btn-outline w-full font-normal tracking-wider delete-btn"
                                    popovertarget="popover-{{ $loop->iteration }}" data-uuid="{{ $item->uuid }}"
                                    data-target="skpd.main-index">
                                    Hapus Data
                                </button>
                            </div>
                        </th>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-2">Belum Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="w-full">
        {{ $data->onEachSide(1)->links() }}
    </div>

    <livewire:modal.data-skpd :tingkat="1" />
</div>

@push('js')
    <script>
        document.addEventListener("livewire:navigated", () => {
            initTomSelect('#kelompok_skpd', {
                maxItems: 1
            });
        });
    </script>
@endpush
