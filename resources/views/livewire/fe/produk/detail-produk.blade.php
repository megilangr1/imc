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
                    <a href="{{ $linkWaMe }}" target="_blank" class="w-full btn btn-success gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-phone-outgoing-icon lucide-phone-outgoing size-5">
                            <path d="m16 8 6-6" />
                            <path d="M22 8V2h-6" />
                            <path
                                d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                        </svg>

                        Hubungi Via Whatsapp
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
