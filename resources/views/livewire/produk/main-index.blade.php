<div class="flex flex-col gap-3">
    <x-main.page-header title="Data Produk">
        <a href="{{ route('produk.create') }}" class="btn btn-neutral btn-sm" wire:navigate>Tambah Data</a>
    </x-main.page-header>

    <div class="w-full grid grid-cols-12">
        <div class="relative w-full col-span-12 md:col-span-8 lg:col-span-4">
            <label class="sr-only" for="filter-search-data-produk">Cari Data :</label>
            <input type="text" name="filter-search-data-produk" id="filter-search-data-produk"
                wire:model.live.debounce.500ms="search"
                class="py-2 px-3 ps-9 block w-full border border-gray-300 text-sm rounded outline-none"
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
    </div>

    <div class="overflow-x-auto border rounded-lg border-slate-300">
        <table class="table table-sm table-pin-rows table-pin-cols">
            <thead>
                <tr>
                    <td class="text-center" width="8%">No.</td>
                    <td>
                        <x-table.th label="Nama Produk" field="nama_produk" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Slug" field="slug_kategori" :orderBy="$order_by" :orderType="$order_type" />
                    </td>

                    <td>
                        <x-table.th label="Pembuat" field="created_at" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="SKU" field="sku" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Brand" field="brand" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Harga" field="harga" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Stok" field="stok" :orderBy="$order_by" :orderType="$order_type" />
                    </td>
                    <td>
                        <x-table.th label="Satuan" field="satuan" :orderBy="$order_by" :orderType="$order_type" />
                    </td>

                    <th class="text-center" width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center bg-slate-200">{{ $loop->iteration }}.</td>
                        <td>{{ $item->nama_produk ?? '-' }}</td>
                        <td>{{ $item->slug_kategori ?? '-' }}</td>
                        <td>{{ $item->nama_creator }}</td>
                        <td>{{ $item->sku ?? '-' }}</td>
                        <td>{{ $item->brand ?? '-' }}</td>
                        <td>Rp.{{ number_format($item->harga, 0, '.', ',') }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>{{ $item->satuan ?? '-' }}</td>
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
                                <a href="{{ route('produk.edit', ['uuid' => $item->uuid]) }}"
                                    class="btn btn-xs btn-outline w-full font-normal tracking-wider"
                                    popovertarget="popover-{{ $loop->iteration }}" wire:navigate>
                                    Edit Data
                                </a>
                                <button type="button" popovertarget="popover-{{ $loop->iteration }}"
                                    class="btn btn-xs btn-outline w-full font-normal tracking-wider delete-btn"
                                    popovertarget="popover-{{ $loop->iteration }}" data-uuid="{{ $item->uuid }}"
                                    data-target="produk.main-index">
                                    Hapus Data
                                </button>
                            </div>
                        </th>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center p-2">Belum Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="w-full">
        {{ $data->onEachSide(1)->links() }}
    </div>
</div>

@push('js')
    <script></script>
@endpush
