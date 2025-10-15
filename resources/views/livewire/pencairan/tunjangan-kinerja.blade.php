<div class="flex flex-col gap-3">
    <x-main.page-header title="Formulir Permohonan Pengajuan Pencairan - Tunjangan Kinerja (TUKIN)">
        <a href="{{ route('pencairan.create') }}" wire:navigate>
            <button type="button" class="btn btn-error btn-sm">Kembali</button>
        </a>
    </x-main.page-header>

    <div class="card border border-slate-300 bg-base-100 w-full">
        <div class="card-body p-0 gap-0">
            <form wire:submit="actionForm">
                <div class="flex flex-col gap-2">
                    <h5 class="py-2 px-3 font-semibold bg-sky-200 rounded-t">Informasi Kegiatan</h5>

                    <div class="w-full grid grid-cols-12 px-4 gap-3">
                        <div class="col-span-12">
                            <div class="flex flex-col sm:flex-row justify-between gap-1 mb-2">
                                <span
                                    class="flex-auto block text-sm font-medium {{ $errors->has('state.id_skpd') ? 'text-red-500' : '' }}"
                                    wire:click="$dispatchTo('modal.data-skpd', 'open-data-skpd-modal')">
                                    Satuan Kerja Perangkat Daerah (SKPD) :
                                </span>
                                <div class="ms-auto">
                                    <div class="flex gap-x-1">
                                        @if ($state['id_skpd'] != null)
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
                                            <svg class="shrink-0 size-2" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="lucide lucide-sheet-icon lucide-sheet">
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
                                <select wire:model="state.id_skpd" id="skpd" name="skpd"
                                    class="w-full @error('state.id_skpd') select-error @enderror"
                                    aria-describedby="skpd-helper">
                                    <option value="">Pilih Kelompok SKPD</option>
                                    @foreach ($staticData['skpd'] as $item)
                                        <option value="{{ $item->uuid }}">
                                            {{ $item->kode_skpd }} - {{ $item->nama_skpd }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state.id_skpd')
                                <p class="text-xs text-red-600 mt-1" id="skpd-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-9">
                            <label for="kegiatan"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.kegiatan') ? 'text-red-500' : '' }}">
                                Kegiatan :
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="state.kegiatan" id="kegiatan" name="kegiatan"
                                    class="w-full input @error('state.kegiatan') input-error @enderror"
                                    aria-describedby="kegiatan-helper" placeholder="Masukan Kegiatan..."
                                    autocomplete="false">
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.kegiatan') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.kegiatan')
                                <p class="text-xs text-red-600 mt-1" id="kegiatan-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-3">
                            <label for="bulan"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.bulan') ? 'text-red-500' : '' }}">
                                Pembayaran Bulan :
                            </label>
                            <div class="relative">
                                <select wire:model="state.bulan" id="bulan" name="bulan"
                                    class="w-full select @error('state.bulan') select-error @enderror"
                                    aria-describedby="bulan-helper" placeholder="Masukan Pembayaran Bulan..." required
                                    autocomplete="false">
                                    <option disabled>Pilih Bulan</option>
                                    @foreach ($staticData['bulan'] as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 end-6 {{ $errors->has('state.bulan') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.bulan')
                                <p class="text-xs text-red-600 mt-1" id="bulan-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-5">
                            <label for="nomor_spm"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.nomor_spm') ? 'text-red-500' : '' }}">
                                Nomor SPM :
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="state.nomor_spm" id="nomor_spm" name="nomor_spm"
                                    class="w-full input @error('state.nomor_spm') input-error @enderror"
                                    aria-describedby="nomor_spm-helper" placeholder="Masukan Nomor SPM..."
                                    autocomplete="false">
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.nomor_spm') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.nomor_spm')
                                <p class="text-xs text-red-600 mt-1" id="nomor_spm-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-3">
                            <label for="tanggal_spm"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.tanggal_spm') ? 'text-red-500' : '' }}">
                                Tanggal SPM :
                            </label>
                            <div class="relative">
                                <input type="date" wire:model="state.tanggal_spm" id="tanggal_spm"
                                    name="tanggal_spm"
                                    class="w-full input @error('state.tanggal_spm') input-error @enderror justify-center"
                                    aria-describedby="tanggal_spm-helper" placeholder="Masukan Tanggal SPM..."
                                    autocomplete="false">
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.tanggal_spm') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.tanggal_spm')
                                <p class="text-xs text-red-600 mt-1" id="tanggal_spm-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-4">
                            <label for="nominal"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.nominal') ? 'text-red-500' : '' }}">
                                Nominal :
                            </label>

                            <div class="relative">
                                <input type="text" wire:model="state.nominal_text" id="nominal" name="nominal"
                                    class="w-full ps-12 input @error('state.nominal') input-error @enderror"
                                    aria-describedby="nominal-helper" placeholder="Masukan Nominal..."
                                    autocomplete="false" x-data
                                    x-on:input="
                                        let raw = $el.value.replace(/[^\d]/g, '');
                                        $wire.set('state.nominal', raw);
                                        $wire.set('state.nominal_text', new Intl.NumberFormat('id-ID').format(raw));
                                    ">
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <span class="text-gray-500 text-sm font-semibold">Rp.</span>
                                </div>
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.nominal') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.nominal')
                                <p class="text-xs text-red-600 mt-1" id="nominal-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12">
                            <label for="keterangan"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.keterangan') ? 'text-red-500' : '' }}">
                                Keterangan :
                            </label>
                            <div class="relative">
                                <textarea type="text" wire:model="state.keterangan" id="keterangan" name="keterangan"
                                    class="w-full textarea @error('state.keterangan') textarea-error @enderror" aria-describedby="keterangan-helper"
                                    placeholder="Masukan Keterangan..." autocomplete="false"></textarea>
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.keterangan') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.keterangan')
                                <p class="text-xs text-red-600 mt-1" id="keterangan-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <h5 class="py-2 px-3 font-semibold bg-sky-200">Informasi Penanggung Jawab Kegiatan</h5>

                    <div class="w-full grid grid-cols-12 px-4 pb-1 gap-3">
                        <div class="col-span-12 md:col-span-12 lg:col-span-4">
                            <label for="nip_pa_kpa"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.nip_pa_kpa') ? 'text-red-500' : '' }}">
                                NIP PA / KPA :
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="state.nip_pa_kpa" id="nip_pa_kpa"
                                    name="nip_pa_kpa"
                                    class="w-full input @error('state.nip_pa_kpa') input-error @enderror"
                                    aria-describedby="nip_pa_kpa-helper" placeholder="Masukan Nama PA / KPA..."
                                    autocomplete="false">
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.nip_pa_kpa') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.nip_pa_kpa')
                                <p class="text-xs text-red-600 mt-1" id="nip_pa_kpa-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-4">
                            <label for="nama_pa_kpa"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.nama_pa_kpa') ? 'text-red-500' : '' }}">
                                Nama PA / KPA :
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="state.nama_pa_kpa" id="nama_pa_kpa"
                                    name="nama_pa_kpa"
                                    class="w-full input @error('state.nama_pa_kpa') input-error @enderror"
                                    aria-describedby="nama_pa_kpa-helper" placeholder="Masukan Nama PA / KPA..."
                                    autocomplete="false">
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.nama_pa_kpa') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.nama_pa_kpa')
                                <p class="text-xs text-red-600 mt-1" id="nama_pa_kpa-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-4">
                            <label for="jabatan_pa_kpa"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.jabatan_pa_kpa') ? 'text-red-500' : '' }}">
                                Jabatan PA / KPA :
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="state.jabatan_pa_kpa" id="jabatan_pa_kpa"
                                    name="jabatan_pa_kpa"
                                    class="w-full input @error('state.jabatan_pa_kpa') input-error @enderror"
                                    aria-describedby="jabatan_pa_kpa-helper" placeholder="Masukan Jabatan PA / KPA..."
                                    autocomplete="false">
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.jabatan_pa_kpa') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.jabatan_pa_kpa')
                                <p class="text-xs text-red-600 mt-1" id="jabatan_pa_kpa-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-4">
                            <label for="nip_ppk"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.nip_ppk') ? 'text-red-500' : '' }}">
                                NIP PPK :
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="state.nip_ppk" id="nip_ppk" name="nip_ppk"
                                    class="w-full input @error('state.nip_ppk') input-error @enderror"
                                    aria-describedby="nip_ppk-helper" placeholder="Masukan Nama PPK..."
                                    autocomplete="false">
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.nip_ppk') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.nip_ppk')
                                <p class="text-xs text-red-600 mt-1" id="nip_ppk-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-4">
                            <label for="nama_ppk"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.nama_ppk') ? 'text-red-500' : '' }}">
                                Nama PPK :
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="state.nama_ppk" id="nama_ppk" name="nama_ppk"
                                    class="w-full input @error('state.nama_ppk') input-error @enderror"
                                    aria-describedby="nama_ppk-helper" placeholder="Masukan Nama PPK..."
                                    autocomplete="false">
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.nama_ppk') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.nama_ppk')
                                <p class="text-xs text-red-600 mt-1" id="nama_ppk-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12 md:col-span-12 lg:col-span-4">
                            <label for="jabatan_ppk"
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.jabatan_ppk') ? 'text-red-500' : '' }}">
                                Jabatan PPK :
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="state.jabatan_ppk" id="jabatan_ppk"
                                    name="jabatan_ppk"
                                    class="w-full input @error('state.jabatan_ppk') input-error @enderror"
                                    aria-describedby="jabatan_ppk-helper" placeholder="Masukan Jabatan PPK..."
                                    autocomplete="false">
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('state.jabatan_ppk') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                            @error('state.jabatan_ppk')
                                <p class="text-xs text-red-600 mt-1" id="jabatan_ppk-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <hr class="border-t-1 border-t-slate-300">

                    <div class="w-full grid grid-cols-12 px-4 pb-3 pt-1 gap-3">
                        <div class="col-span-12 md:col-span-6 lg:col-span-3">
                            <button type="submit" class="btn btn-neutral w-full">
                                {{ isset($editData) ? 'Simpan Data' : 'Buat Data' }}
                            </button>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-3">
                            <button type="{{ $editData ? 'button' : 'reset' }}" class="btn btn-error w-full"
                                @isset($editData) wire:click="showForm(false)" @endisset>
                                {{ isset($editData) ? 'Batalkan' : 'Reset Input' }}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
            <div class="card-actions text-xs font-semibold text-slate-600 bg-slate-200 rounded-b-lg px-5 py-2">
                Formulir Permohonan Pengajuan Pencairan - Tunjangan Kinerja (TUKIN)
            </div>
        </div>
    </div>

    <livewire:modal.data-skpd />
</div>

@push('js')
    <script>
        document.addEventListener("livewire:navigated", () => {
            initTomSelect('#skpd', {
                maxItems: 1
            });
        });
    </script>
@endpush
