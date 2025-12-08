<div>
    <!-- Daftar Katalog Produk -->
    <section id="products" class="py-16">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center">Daftar Katalog Produk</h3>
            <p class="text-center mt-2 text-sm text-gray-500">Kami menyediakan berbagai solusi IT yang siap
                mendukung bisnis Anda.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">

                <div class="card bg-base-100 w-full shadow-sm border border-slate-400">
                    <div class="w-full flex flex-col items-center justify-center py-4 px-3">
                        <h2 class="text-xl font-semibold tracking-wider">Test AWOKAOWKOAWK</h2>
                    </div>
                    <figure>
                        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                            alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Card Title</h2>
                        <p>A card component has a figure, a body part, and inside body there are title and actions parts
                        </p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 w-full shadow-sm">
                    <figure>
                        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                            alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Card Title</h2>
                        <p>A card component has a figure, a body part, and inside body there are title and actions parts
                        </p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 w-full shadow-sm">
                    <figure>
                        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                            alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Card Title</h2>
                        <p>A card component has a figure, a body part, and inside body there are title and actions parts
                        </p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 w-full shadow-sm">
                    <figure>
                        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                            alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Card Title</h2>
                        <p>A card component has a figure, a body part, and inside body there are title and actions parts
                        </p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                @php
                    $services = [
                        [
                            'title' => 'Servis & Maintenance Komputer',
                            'desc' => 'Perawatan, perbaikan, dan peningkatan performa perangkat komputer dan laptop.',
                        ],
                        [
                            'title' => 'Pengadaan Perangkat IT',
                            'desc' => 'Penjualan dan penyediaan perangkat keras serta perangkat lunak original.',
                        ],
                        [
                            'title' => 'Pembuatan Website & Aplikasi',
                            'desc' => 'Solusi digital untuk bisnis, UMKM, dan instansi pemerintahan.',
                        ],
                        [
                            'title' => 'Jaringan & Infrastruktur IT',
                            'desc' => 'Instalasi dan konfigurasi jaringan LAN/WiFi, server, dan sistem keamanan data.',
                        ],
                        [
                            'title' => 'Konsultasi & Dukungan IT',
                            'desc' =>
                                'Layanan konsultasi teknologi untuk peningkatan efisiensi dan produktivitas kerja.',
                        ],
                    ];
                @endphp

                @foreach ($services as $service)
                    <div class="card bg-base-100 shadow hover:shadow-lg transition-all">
                        <div class="card-body">
                            <h4 class="card-title text-primary">{{ $service['title'] }}</h4>
                            <p class="text-sm text-gray-600">{{ $service['desc'] }}</p>
                        </div>
                    </div>
                @endforeach

                <a href="{{ route('main') }}" class="card bg-base-100 shadow hover:shadow-lg transition-all group">
                    <div class="card-body gap-4">
                        <h4
                            class="card-title text-info items-center justify-center group-hover:scale-105 transition-transform duration-500">
                            Daftar Katalog Produk Kami
                        </h4>
                        <button type="button"
                            class="btn btn-sm btn-outline btn-info max-w-40 mx-auto group-hover:scale-105 transition-all duration-500">
                            Buka Katalog
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-chevron-right-icon lucide-chevron-right shrink-0 size-4">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </button>
                    </div>
                </a>
            </div>
        </div>
    </section>
</div>
