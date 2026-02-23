<div>
    <!-- HERO -->
    <section class="hero min-h-[20vh] md:min-h-[25vh] bg-cover bg-center"
        style="background-image: url('{{ asset('img/banner-2.jpg') }}')">
        <div class="hero-overlay bg-opacity-50"></div>
        <div class="container mx-auto px-4 py-4 text-center text-white">
            <h1 class="text-2xl md:text-4xl font-bold leading-tight mt-4">
                DAFTAR KATALOG PRODUK
            </h1>
            <hr class="border-t-4 border-white w-[40%] mx-auto mt-4">
            <p class="text-sm pt-4">IMCOMPUTER</p>
            <p class="text-sm pt-2">
                Kami menyediakan berbagai solusi IT yang siap
                mendukung bisnis Anda.
            </p>
        </div>
    </section>

    <!-- Daftar Katalog Produk -->
    <section id="products" class="container max-w-6xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            @foreach ($data as $item)
                <a href="{{ route('detail-produk', ['slug' => $item->slug_produk]) }}"
                    class="card bg-base-100 hover:bg-black w-full shadow-lg group hover:scale-105 transition-all duration-500 ease-in-out"
                    wire:navigate>
                    <figure class="bg-cover bg-center min-h-56"
                        style="background-image: url({{ route('public-file.view', ['folder' => $item->folder, 'filename' => $item->filename]) }})">
                    </figure>
                    <div class="card-body">
                        <span
                            class="text-xs group-hover:text-white transition-all duration-500 ease-in-out">{{ $item->kategori->nama_kategori ?? '-' }}</span>
                        <h2 class="card-title group-hover:text-white transition-all duration-500 ease-in-out">
                            {{ $item->nama_produk ?? '-' }}</h2>
                        <p class="group-hover:text-white transition-all duration-500 ease-in-out">
                            Harga : Rp. {{ number_format($item->harga, 0, ',', '.') }}
                        </p>
                        <div
                            class="card-actions justify-end group-hover:text-white transition-all duration-500 ease-in-out">
                            <button class="btn btn-info">Rincian</button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="w-full pt-4">
            {{ $data->onEachSide(1)->links() }}
        </div>
    </section>
</div>
