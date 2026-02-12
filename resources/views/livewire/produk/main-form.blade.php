<div class="flex flex-col gap-3">
    <x-main.page-header title="Data Produk">
        <a href="{{ route('produk.index') }}" class="btn btn-error btn-sm" wire:navigate>Kembali</a>
    </x-main.page-header>

    <div class="card border border-slate-300 bg-base-100 w-full">
        <div class="card-body p-0">
            <div class="card-title px-5 py-3 border-b border-b-slate-300 text-sm flex items-center justify-between">
                <div class="flex-auto">
                    Formulir {{ $editData ? 'Ubah' : 'Tambah' }} Produk
                </div>
            </div>
            <form wire:submit="actionForm">
                <div class="w-full grid grid-cols-6 px-6 pb-2 gap-3">

                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <div class="flex flex-col sm:flex-row justify-between gap-1 mb-2">
                            <span
                                class="flex-auto block text-sm font-medium {{ $errors->has('state.id_kategori') ? 'text-red-500' : '' }}"
                                wire:click="$dispatchTo('modal.data-kategori', 'open-data-kategori-modal')">
                                Kategori Produk :
                                <span class="text-red-500 text-xs">*</span>
                            </span>
                            <div class="ms-auto">
                                <div class="flex gap-x-1">
                                    @if ($state['id_kategori'] != null)
                                        <span class="badge badge-xs badge-error cursor-pointer text-white"
                                            wire:click="resetSelectedKategori">
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
                                        wire:click="$dispatchTo('modal.data-kategori', 'open-data-kategori-modal')">
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
                            <select wire:model="state.id_kategori" id="kategori" name="kategori"
                                class="w-full @error('state.id_kategori') select-error @enderror"
                                aria-describedby="kategori-helper">
                                <option value="">Pilih Kelompok Kategori Produk</option>
                                @foreach ($staticData['kategori'] as $item)
                                    <option value="{{ $item->uuid }}">
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('state.id_kategori')
                            <p class="text-xs text-red-600 mt-1" id="kategori-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="nama_produk"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.nama_produk') ? 'text-red-500' : '' }}">
                            Nama Produk :
                            <span class="text-red-500 text-xs">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.nama_produk" id="nama_produk" name="nama_produk"
                                class="w-full input @error('state.nama_produk') input-error @enderror"
                                aria-describedby="nama_produk-helper" placeholder="Masukan Nama Produk..." required
                                autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.nama_produk') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.nama_produk')
                            <p class="text-xs text-red-600 mt-1" id="nama_produk-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-3 lg:col-span-3">
                        <label for="sku"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.sku') ? 'text-red-500' : '' }}">
                            SKU :
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.sku" id="sku" name="sku"
                                class="w-full input @error('state.sku') input-error @enderror"
                                aria-describedby="sku-helper" placeholder="Masukan SKU..." autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.sku') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.sku')
                            <p class="text-xs text-red-600 mt-1" id="sku-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-3 lg:col-span-3">
                        <label for="brand"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.brand') ? 'text-red-500' : '' }}">
                            Brand Produk :
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.brand" id="brand" name="brand"
                                class="w-full input @error('state.brand') input-error @enderror"
                                aria-describedby="brand-helper" placeholder="Masukan Brand Produk..."
                                autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.brand') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.brand')
                            <p class="text-xs text-red-600 mt-1" id="brand-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-2 lg:col-span-2">
                        <label for="harga"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.harga') ? 'text-red-500' : '' }}">
                            Harga Produk :
                        </label>


                        <div class="relative">
                            <input type="text" wire:model="state.harga_text" id="harga" name="harga"
                                class="w-full ps-12 input @error('state.harga') input-error @enderror"
                                aria-describedby="harga-helper" placeholder="Masukan Nominal..." autocomplete="false"
                                x-data
                                x-on:input="
                                    let raw = $el.value.replace(/[^\d]/g, '');
                                    $wire.set('state.harga', raw);
                                    $wire.set('state.harga_text', new Intl.NumberFormat('id-ID').format(raw));
                                ">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                <span class="text-gray-500 text-sm font-semibold">Rp.</span>
                            </div>
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.harga') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.harga')
                            <p class="text-xs text-red-600 mt-1" id="harga-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-2 lg:col-span-2">
                        <label for="stok"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.stok') ? 'text-red-500' : '' }}">
                            Stok Produk :
                        </label>
                        <div class="relative">
                            <input type="number" wire:model="state.stok_text" id="stok" name="stok"
                                class="w-full input @error('state.stok') input-error @enderror"
                                aria-describedby="stok-helper" placeholder="Masukan Stok Produk..."
                                autocomplete="false" x-data
                                x-on:input="
                                    let raw = $el.value.replace(/[^\d]/g, '');
                                    $wire.set('state.stok', raw);
                                    $wire.set('state.stok_text', new Intl.NumberFormat('id-ID').format(raw));
                                ">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.stok') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.stok')
                            <p class="text-xs text-red-600 mt-1" id="stok-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-2 lg:col-span-2">
                        <label for="satuan"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.satuan') ? 'text-red-500' : '' }}">
                            Satuan Produk :
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.satuan" id="satuan" name="satuan"
                                class="w-full input @error('state.satuan') input-error @enderror"
                                aria-describedby="satuan-helper" placeholder="Masukan Satuan Produk..."
                                autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.satuan') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.satuan')
                            <p class="text-xs text-red-600 mt-1" id="satuan-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6">
                        <label
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.deskripsi') ? 'text-red-500' : '' }}">
                            Deskripsi Produk :
                        </label>
                        <div wire:ignore x-data="{ value: @entangle('state.deskripsi').defer }" x-init="$refs.trixEditor.addEventListener('trix-change', (e) => {
                            $wire.set('state.deskripsi', $refs.hiddenInput.value);
                        });
                        $refs.hiddenInput.value = value;">
                            <input id="deskripsi_input" type="hidden" x-ref="hiddenInput"
                                wire:model.live="state.deskripsi" value="{{ $state['deskripsi'] ?? '' }}">

                            {{-- 2. Trix Editor terhubung ke input di atas --}}
                            <trix-editor x-ref="trixEditor" input="deskripsi_input"
                                class="trix-content bg-white border border-base-300 rounded-lg min-h-40"></trix-editor>
                        </div>

                        @error('state.deskripsi')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="foto"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.foto') ? 'text-red-500' : '' }}">
                            Foto Produk :
                        </label>
                        <div class="relative">
                            <input type="file" wire:model="state.foto" id="foto" name="foto"
                                class="w-full file-input @error('state.foto') file-input-error @enderror"
                                aria-describedby="foto-helper" placeholder="Upload Foto Produk..."
                                autocomplete="false" accept=".jpg,.jpeg,.png"
                                @if (!$editData) required @endif>
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.foto') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        <div wire:loading wire:target="state.foto" class="text-sm text-blue-500 mt-1">
                            Memeriksa File...
                        </div>
                        @error('state.foto')
                            <p class="text-xs text-red-600 mt-1" id="foto-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    @if ($state['foto'] != null && !$errors->has('state.foto'))
                        <div class="col-span-6 md:col-span-2 lg:col-span-2">
                            <label
                                class="block text-sm font-medium mb-2 {{ $errors->has('state.foto') ? 'text-red-500' : '' }}">
                                Foto di-Upload :
                            </label>
                            <div class="bg-cover bg-center rounded-lg shadow-lg min-h-80 w-auto"
                                style="background-image: url({{ $state['foto']->temporaryUrl() }})"></div>
                        </div>
                    @endif

                    @if ($editData && $editData->filename != null)
                        <div class="col-span-6 md:col-span-2 lg:col-span-2">
                            <label class="block text-sm font-medium mb-2">
                                Foto Saat Ini :
                            </label>
                            <div class="bg-cover bg-center rounded-lg shadow-lg min-h-80 w-auto"
                                style="background-image: url({{ route('public-file.view', ['folder' => $editData->folder, 'filename' => $editData->filename]) }})">
                            </div>
                        </div>
                    @endif


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
                            @isset($editData) wire:click="setState()" @endisset>
                            {{ isset($editData) ? 'Batalkan' : 'Reset Input' }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="card-actions text-xs font-semibold text-slate-600 bg-slate-200 rounded-b-lg px-5 py-2">
                Formulir {{ $editData ? 'Ubah' : 'Tambah' }} Produk
            </div>
        </div>
    </div>

    <livewire:modal.data-kategori />
</div>

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.css">
    <script src="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.umd.min.js"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none !important;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener("livewire:navigated", () => {
            initTomSelect('#kategori', {
                maxItems: 1
            });
        });
    </script>
@endpush
