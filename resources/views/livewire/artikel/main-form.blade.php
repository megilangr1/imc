<div class="flex flex-col gap-3">
    <x-main.page-header title="Data Artikel">
        <a href="{{ route('artikel.index') }}" class="btn btn-error btn-sm" wire:navigate>Kembali</a>
    </x-main.page-header>

    <div class="card border border-slate-300 bg-base-100 w-full">
        <div class="card-body p-0">
            <div class="card-title px-5 py-3 border-b border-b-slate-300 text-sm flex items-center justify-between">
                <div class="flex-auto">
                    Formulir {{ $editData ? 'Ubah' : 'Tambah' }} Artikel
                </div>
            </div>
            <form wire:submit="actionForm">
                <div class="w-full grid grid-cols-6 px-6 pb-2 gap-3">

                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="judul"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.judul') ? 'text-red-500' : '' }}">
                            Judul Artikel :
                            <span class="text-red-500 text-xs">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.judul" id="judul" name="judul"
                                class="w-full input @error('state.judul') input-error @enderror"
                                aria-describedby="judul-helper" placeholder="Masukan Judul Artikel..." required
                                autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.judul') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.judul')
                            <p class="text-xs text-red-600 mt-1" id="judul-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="desc"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.desc') ? 'text-red-500' : '' }}">
                            Deskripsi Singkat :
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.desc" id="desc" name="desc"
                                class="w-full input @error('state.desc') input-error @enderror"
                                aria-describedby="desc-helper" placeholder="Masukan Deskripsi Singkat..."
                                autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.desc') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.desc')
                            <p class="text-xs text-red-600 mt-1" id="desc-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-6">
                        <label
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.content') ? 'text-red-500' : '' }}">
                            Deskripsi Artikel :
                        </label>
                        <div wire:ignore x-data="{ value: @entangle('state.content').defer }" x-init="$refs.trixEditor.addEventListener('trix-change', (e) => {
                            $wire.set('state.content', $refs.hiddenInput.value);
                        });
                        $refs.hiddenInput.value = value;">
                            <input id="content_input" type="hidden" x-ref="hiddenInput" wire:model.live="state.content"
                                value="{{ $state['content'] ?? '' }}">

                            {{-- 2. Trix Editor terhubung ke input di atas --}}
                            <trix-editor x-ref="trixEditor" input="content_input"
                                class="trix-content bg-white border border-base-300 rounded-lg min-h-40"></trix-editor>
                        </div>

                        @error('state.content')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="foto"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.foto') ? 'text-red-500' : '' }}">
                            Foto Artikel :
                        </label>
                        <div class="relative">
                            <input type="file" wire:model="state.foto" id="foto" name="foto"
                                class="w-full file-input @error('state.foto') file-input-error @enderror"
                                aria-describedby="foto-helper" placeholder="Upload Foto Artikel..."
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
                Formulir {{ $editData ? 'Ubah' : 'Tambah' }} Artikel
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
        document.addEventListener("livewire:navigated", () => {});
    </script>
@endpush
