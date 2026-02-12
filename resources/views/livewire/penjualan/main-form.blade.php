<div class="flex flex-col gap-3">
    <x-main.page-header title="Data Penjualan / Invoice / Kuitansi">
        <a href="{{ route('penjualan.index') }}" class="btn btn-error btn-sm" wire:navigate>Kembali</a>
    </x-main.page-header>

    <div class="card border border-slate-300 bg-base-100 w-full">
        <div class="card-body p-0">
            <div class="card-title px-5 py-3 border-b border-b-slate-300 text-sm flex items-center justify-between">
                <div class="flex-auto">
                    Formulir {{ $editData ? 'Ubah' : 'Tambah' }} Data Penjualan / Invoice / Kuitansi
                </div>
            </div>
            <form wire:submit="actionForm">
                <div class="w-full grid grid-cols-12 px-6 pb-2 gap-3">

                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <label for="nomor_nota"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.nomor_nota') ? 'text-red-500' : '' }}">
                            Nomor Nota / Kuitansi :
                            <span class="text-red-500 text-xs">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.nomor_nota" id="nomor_nota" name="nomor_nota"
                                class="w-full input @error('state.nomor_nota') input-error @enderror"
                                aria-describedby="nomor_nota-helper" placeholder="Masukan Nomor Nota / Kuitansi..."
                                required autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.nomor_nota') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.nomor_nota')
                            <p class="text-xs text-red-600 mt-1" id="nomor_nota-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-8">
                        <label for="nama_pekerjaan"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.nama_pekerjaan') ? 'text-red-500' : '' }}">
                            Nama Pekerjaan :
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.nama_pekerjaan" id="nama_pekerjaan"
                                name="nama_pekerjaan"
                                class="w-full input @error('state.nama_pekerjaan') input-error @enderror"
                                aria-describedby="nama_pekerjaan-helper" placeholder="Masukan Nama Pekerjaan..."
                                required autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.nama_pekerjaan') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.nama_pekerjaan')
                            <p class="text-xs text-red-600 mt-1" id="nama_pekerjaan-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <label for="pemilik_pekerjaan"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.pemilik_pekerjaan') ? 'text-red-500' : '' }}">
                            Pemilik Pekerjaan :
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.pemilik_pekerjaan" id="pemilik_pekerjaan"
                                name="pemilik_pekerjaan"
                                class="w-full input @error('state.pemilik_pekerjaan') input-error @enderror"
                                aria-describedby="pemilik_pekerjaan-helper" placeholder="Masukan Pemilik Pekerjaan..."
                                required autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.pemilik_pekerjaan') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.pemilik_pekerjaan')
                            <p class="text-xs text-red-600 mt-1" id="pemilik_pekerjaan-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <label for="tempat_pekerjaan"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.tempat_pekerjaan') ? 'text-red-500' : '' }}">
                            Tempat Pekerjaan :
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.tempat_pekerjaan" id="tempat_pekerjaan"
                                name="tempat_pekerjaan"
                                class="w-full input @error('state.tempat_pekerjaan') input-error @enderror"
                                aria-describedby="tempat_pekerjaan-helper" placeholder="Masukan Tempat Pekerjaan..."
                                required autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.tempat_pekerjaan') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.tempat_pekerjaan')
                            <p class="text-xs text-red-600 mt-1" id="tempat_pekerjaan-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <label for="tanggal_pekerjaan"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.tanggal_pekerjaan') ? 'text-red-500' : '' }}">
                            Tanggal Pekerjaan :
                        </label>
                        <div class="relative">
                            <input type="date" wire:model="state.tanggal_pekerjaan" id="tanggal_pekerjaan"
                                name="tanggal_pekerjaan"
                                class="w-full input @error('state.tanggal_pekerjaan') input-error @enderror"
                                aria-describedby="tanggal_pekerjaan-helper" placeholder="Masukan Tanggal Pekerjaan..."
                                required autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.tanggal_pekerjaan') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.tanggal_pekerjaan')
                            <p class="text-xs text-red-600 mt-1" id="tanggal_pekerjaan-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <label for="tanda_terima_pekerjaan"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.tanda_terima_pekerjaan') ? 'text-red-500' : '' }}">
                            TTD / Tanda Terima :
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.tanda_terima_pekerjaan"
                                id="tanda_terima_pekerjaan" name="tanda_terima_pekerjaan"
                                class="w-full input @error('state.tanda_terima_pekerjaan') input-error @enderror"
                                aria-describedby="tanda_terima_pekerjaan-helper"
                                placeholder="Masukan TTD / Tanda Terima..." required autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.tanda_terima_pekerjaan') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.tanda_terima_pekerjaan')
                            <p class="text-xs text-red-600 mt-1" id="tanda_terima_pekerjaan-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12 flex flex-col gap-1">
                        <h6>Rincian Pekerjaan : </h6>
                        <hr class="border-t-1 border-t-slate-300">
                    </div>

                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                        <label for="item"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.item') ? 'text-red-500' : '' }}">
                            Nama Item :
                        </label>
                        <div class="relative">
                            <input type="text" wire:model="state.item" id="item" name="item"
                                class="w-full input @error('state.item') input-error @enderror"
                                aria-describedby="item-helper" placeholder="Masukan Nama Item..."
                                autocomplete="false">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.item') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.item')
                            <p class="text-xs text-red-600 mt-1" id="item-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12 md:col-span-4 lg:col-span-2">
                        <label for="jumlah"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.jumlah') ? 'text-red-500' : '' }}">
                            Jumlah :
                        </label>
                        <div class="relative">
                            <input type="number" wire:model="state.jumlah_text" id="jumlah" name="jumlah"
                                class="w-full input @error('state.jumlah') input-error @enderror"
                                aria-describedby="jumlah-helper" placeholder="Masukan Jumlah..." autocomplete="false"
                                x-data
                                x-on:input="
                                        let raw = $el.value.replace(/[^\d]/g, '');
                                        $wire.set('state.jumlah', raw);
                                        $wire.set('state.jumlah_text', new Intl.NumberFormat('id-ID').format(raw));
                                    ">
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('state.jumlah') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        @error('state.jumlah')
                            <p class="text-xs text-red-600 mt-1" id="jumlah-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12 md:col-span-4 lg:col-span-3">
                        <label for="harga"
                            class="block text-sm font-medium mb-2 {{ $errors->has('state.harga') ? 'text-red-500' : '' }}">
                            Harga :
                        </label>

                        <div class="relative">
                            <input type="text" wire:model="state.harga_text" id="harga" name="harga"
                                class="w-full ps-12 input @error('state.harga') input-error @enderror"
                                aria-describedby="harga-helper" placeholder="Masukan Harga..." autocomplete="false"
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

                    <div class="col-span-12 md:col-span-12 lg:col-span-3">
                        <label for="item" class="hidden lg:block text-sm font-medium mb-2">
                            &ensp;
                        </label>

                        <button type="button" class="btn btn-neutral btn-dash btn-sm btn-block h-10"
                            wire:click="tambahItem">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-plus-icon lucide-plus size-4">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Tambah Item
                        </button>
                    </div>

                    <div class="col-span-12">
                        <div class="overflow-x-auto border rounded-lg border-slate-300">
                            <table class="table table-sm table-pin-rows table-pin-cols">
                                <thead>
                                    <tr>
                                        <td class="text-center" width="8%">No.</td>
                                        <td>Nama Produk / Item</td>
                                        <td class="text-center">Jumlah</td>
                                        <td class="text-center">Harga</td>
                                        <td class="text-center">Sub Total</td>
                                        <th class="text-center" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($state['detail'] as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}.</td>
                                            <td>{{ $item['item'] ?? '-' }}</td>
                                            <td class="text-center">
                                                {{ number_format($item['jumlah'] ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <div class="flex items-center justify-between gap-2">
                                                    <span class="text-xs">Rp.</span>
                                                    <span
                                                        class="font-semibold">{{ number_format($item['harga'] ?? 0, 2, ',', '.') }}</span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="flex items-center justify-between gap-2">
                                                    <span class="text-xs">Rp.</span>
                                                    <span
                                                        class="font-semibold">{{ number_format($item['jumlah'] * $item['harga'], 2, ',', '.') }}</span>
                                                </div>
                                            </td>
                                            <th class="text-center">
                                                <button type="button" class="btn btn-error w-full btn-xs"
                                                    wire:click="hapusItem('{{ $key }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="lucide lucide-trash2-icon lucide-trash-2 size-4">
                                                        <path d="M10 11v6" />
                                                        <path d="M14 11v6" />
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                        <path d="M3 6h18" />
                                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    </svg>
                                                </button>
                                            </th>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center p-2">Belum Ada Data</td>
                                        </tr>
                                    @endforelse

                                    <tr>
                                        <td class="text-end font-semibold bg-slate-200" colspan="4">Total : </td>
                                        <td class="bg-slate-200">
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs">Rp.</span>
                                                <span
                                                    class="font-semibold">{{ number_format(array_sum(array_column($state['detail'], 'sub_total')), 2, ',', '.') }}</span>
                                            </div>
                                        </td>
                                        <td class="bg-slate-200"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="col-span-12">
                        <hr class="border-t-1 border-t-slate-300">
                    </div>

                    <div class="col-span-12 md:col-span-4 lg:col-span-3">
                        <button type="submit" class="btn btn-neutral w-full btn-sm">
                            {{ isset($editData) ? 'Simpan Data' : 'Buat Data' }}
                        </button>
                    </div>
                    <div class="col-span-12 md:col-span-4 lg:col-span-3">
                        <button type="{{ $editData ? 'button' : 'reset' }}" class="btn btn-error w-full btn-sm"
                            @isset($editData) wire:click="setState()" @endisset>
                            {{ isset($editData) ? 'Batalkan' : 'Reset Input' }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="card-actions text-xs font-semibold text-slate-600 bg-slate-200 rounded-b-lg px-5 py-2">
                Formulir {{ $editData ? 'Ubah' : 'Tambah' }} Data Penjualan / Invoice / Kuitansi
            </div>
        </div>
    </div>

    <livewire:modal.data-kategori />
</div>

@push('js')
    <script>
        document.addEventListener("livewire:navigated", () => {});
    </script>
@endpush
