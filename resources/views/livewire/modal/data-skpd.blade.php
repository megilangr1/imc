<div>
    <input type="checkbox" id="modal_data_skpd" class="modal-toggle" wire:model.live="modal" />
    <div class="modal modal-bottom sm:modal-middle" role="dialog">
        <div class="modal-box flex flex-col p-0 sm:w-[70vw] sm:max-w-full">
            <h3 class="text-lg font-bold px-4 py-3">Daftar Satuan Kerja Perangkat Daerah (SKPD)</h3>
            <hr class="border-t border-t-slate-300">

            <div class="relative w-full">
                <label class="sr-only" for="filter-search-skpd">Cari Data :</label>
                <input type="text" name="filter-search-skpd" id="filter-search-skpd"
                    wire:model.live.debounce.500ms="search"
                    class="py-2 px-3 ps-9 block w-full border-gray-200 text-sm rounded-none outline-none"
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
            <div class="overflow-x-auto border rounded-none border-slate-300">
                <table class="table table-sm table-pin-rows table-pin-cols">
                    <thead>
                        <tr>
                            <td class="bg-slate-200 text-center" width="8%">No.</td>
                            <td class="bg-slate-200">Kode SKPD</td>
                            <td class="bg-slate-200">Nama SKPD</td>
                            <th class="bg-slate-200 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center bg-slate-200">{{ $loop->iteration }}.</td>
                                <td>{{ $item->kode_skpd }}</td>
                                <td>{{ $item->nama_skpd }}</td>
                                <th class="text-center">
                                    <button type="button" wire:click="selectSkpd('{{ $item->uuid }}')"
                                        class="btn btn-xs btn-neutral w-full font-normal tracking-wider text-nowrap">
                                        Pilih Data
                                    </button>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center p-2">Belum Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-2 border-t border-t-slate-300">
                <div class="w-full text-xs">
                    Menampilkan <span
                        class="font-semibold">{{ $data->perPage() > $data->total() ? $data->total() : $data->perPage() }}</span>
                    dari {{ $data->total() }}
                    Total Data.
                    <hr class="my-1">
                    <div class="font-semibold">
                        Silahkan Lakukan Pencarian Data Untuk Data Lainnya.
                    </div>
                </div>
            </div>
        </div>
        <label class="modal-backdrop" for="modal_data_skpd">Close</label>
    </div>
</div>
