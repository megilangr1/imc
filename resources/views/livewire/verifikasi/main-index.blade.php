<div class="flex flex-col gap-3">
    <x-main.page-header title="Data Permohonan Verifikasi">
        <a href="{{ route('pencairan.create') }}" wire:navigate>
            <button type="button" class="btn btn-neutral btn-sm">Tambah Data</button>
        </a>
    </x-main.page-header>

    <div class="w-full grid grid-cols-12 gap-x-3 gap-y-2">
        <div class="relative w-full col-span-12 md:col-span-8 lg:col-span-4">
            <label class="sr-only" for="filter-search-data-pengajuan">Cari Data :</label>
            <input type="text" name="filter-search-data-pengajuan" id="filter-search-data-pengajuan"
                wire:model.live.debounce.500ms="search"
                class="input px-3 ps-9 block w-full border border-gray-300 text-sm rounded outline-none focus:outline-0 focus:z-0"
                placeholder="Masukan Keyword Untuk Melakukan Pencarian...">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
            </div>
        </div>

        <div class="col-span-12 md:col-span-12 lg:col-span-3">
            <select wire:model.live="status" id="status" name="status" class="w-full select"
                placeholder="Pilih Status Verifikasi..." autocomplete="false" required>
                <option value="">Semua Status</option>
                @foreach ($staticData['status'] as $key => $item)
                    <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
            </select>
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
                        <x-table.th label="SKPD" field="kode_skpd" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Jenis Pengajuan" field="kode_jenis_pengajuan" :orderBy="$order_by"
                            :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Nomor SPM" field="nomor_spm" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Tanggal SPM" field="tanggal_spm" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Status" field="status" :orderBy="$order_by" :orderType="$order_type"
                            class="text-center" />
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
                        <td>{{ $item->nama_skpd }}</td>
                        <td>{{ $item->nama_jenis_pengajuan }}</td>
                        <td>{{ $item->nomor_spm }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->tanggal_spm)) }}</td>
                        <td class="font-semibold text-center">{{ $item->status_label }}</td>
                        <td>{{ $item->nama_creator }}</td>
                        <th class="text-center">
                            @if ($item->status === 1)
                                <a href="{{ route('verifikasi.verify', ['uuid' => $item->uuid]) }}"
                                    class="btn btn-xs btn-success text-white w-full tracking-wider">
                                    Verifikasi
                                </a>
                            @endif

                            @if ($item->status === 3)
                                <a href="{{ route('verifikasi.detail', ['uuid' => $item->uuid]) }}"
                                    class="btn btn-xs btn-neutral w-full tracking-wider">
                                    Detail
                                </a>
                            @endif
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
