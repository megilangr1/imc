<div>
    <!-- HERO -->
    <section class="hero min-h-[20vh] md:min-h-[25vh] bg-cover bg-center"
        style="background-image: url('{{ asset('img/banner-2.jpg') }}')">
        <div class="hero-overlay bg-opacity-50"></div>
        <div class="container mx-auto px-4 py-4 text-center text-white">
            <h1 class="text-2xl md:text-4xl font-bold leading-tight mt-4">
                Rincian Produk
            </h1>
            <hr class="border-t-4 border-white w-[40%] mx-auto mt-4">
            <p class="text-sm pt-4">IMCOMPUTER</p>
            <p class="text-sm pt-2">
                Kami menyediakan berbagai solusi IT yang siap
                mendukung bisnis Anda.
            </p>
        </div>
    </section>

    <section id="product" class="container max-w-4xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="w-full">
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ route('public-file.view', ['folder' => $detailData->folder, 'filename' => $detailData->filename]) }}"
                        alt="{{ $detailData->nama_produk }}" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <div>
                    <span class="text-sm text-gray-500">
                        {{ $detailData->kategori->nama_kategori ?? 'Uncategorized' }}
                    </span>
                    <h1 class="text-2xl font-semibold text-gray-900 mt-1">
                        {{ $detailData->nama_produk }}
                    </h1>
                </div>

                <div class="text-xl font-bold text-indigo-600">
                    Rp {{ number_format($detailData->harga, 0, ',', '.') }}
                </div>

                <div>
                    @if ($detailData->stok > 0)
                        <span class="inline-block px-3 py-1 text-sm bg-green-100 text-green-700 rounded-full">
                            Stok tersedia: {{ $detailData->stok }}
                        </span>
                    @else
                        <span class="inline-block px-3 py-1 text-sm bg-red-100 text-red-700 rounded-full">
                            Stok habis
                        </span>
                    @endif
                </div>

                <div class="border-t pt-4 text-gray-700 leading-relaxed">
                    {!! nl2br($detailData->deskripsi) !!}
                </div>

                {{-- Optional action --}}
                <div class="mt-6">
                    <button
                        class="w-full md:w-auto px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition"
                        wire:click="addToCart">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
