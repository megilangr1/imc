<div>
    <!-- HERO -->
    <section class="hero min-h-[70vh] bg-cover bg-center"
        style="background-image: url('{{ asset('img/banner-2.jpg') }}')">
        <div class="hero-overlay bg-opacity-50"></div>
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                Solusi Digital Terpercaya untuk Bisnis Modern
            </h1>
            <p class="mt-4 max-w-2xl mx-auto">
                IMCOMPUTER menghadirkan layanan teknologi komputer dan IT yang inovatif, efisien, serta
                berdaya saing tinggi.
            </p>
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#about" class="btn btn-primary btn-lg max-w-xs">Tentang Kami</a>
                <a href="{{ route('katalog-produk') }}" class="btn btn-ghost btn-lg max-w-xs" wire:navigate>
                    Katalog Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="about" class="py-16 bg-base-100">
        <div class="container mx-auto px-4 grid md:grid-cols-2 gap-8 items-center">
            <div>
                <h2 class="text-3xl font-bold mb-4">Tentang <span class="text-primary">IMCOMPUTER</span>
                </h2>
                <p class="text-lg leading-relaxed">
                    IMCOMPUTER adalah perusahaan yang bergerak di bidang teknologi komputer dan layanan
                    teknologi informasi (IT).
                    Kami hadir sebagai mitra terpercaya dalam menyediakan solusi digital yang inovatif,
                    efisien, dan sesuai dengan kebutuhan bisnis modern.
                </p>
                <p class="mt-4 text-lg leading-relaxed">
                    Sejak awal berdirinya, kami berkomitmen membantu individu, instansi, dan perusahaan
                    dalam memanfaatkan teknologi komputer secara optimal —
                    mulai dari pengadaan perangkat keras, pengembangan perangkat lunak, hingga dukungan
                    teknis yang berkelanjutan.
                </p>
                <p class="mt-4 text-lg leading-relaxed">
                    Dengan tim profesional berpengalaman di bidang IT, kami terus berinovasi menghadirkan
                    layanan yang mengutamakan kecepatan, keamanan, dan keandalan sistem.
                </p>
            </div>
            <div>
                <img src="{{ asset('img/banner-1.jpg') }}" alt="Tentang IMCOMPUTER" class="rounded-lg shadow-lg " />
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-16 bg-base-200">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-8">Visi & Misi</h3>

            <div class="grid md:grid-cols-2 gap-8 text-left">
                <div class="card bg-base-100 shadow p-6">
                    <h4 class="font-bold text-xl mb-3 text-primary">Visi</h4>
                    <p>Menjadi perusahaan teknologi komputer terpercaya di Indonesia yang memberikan solusi
                        digital terbaik dan berdaya saing tinggi.</p>
                </div>
                <div class="card bg-base-100 shadow p-6">
                    <h4 class="font-bold text-xl mb-3 text-primary">Misi</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Memberikan pelayanan terbaik dalam bidang teknologi informasi.</li>
                        <li>Mengembangkan inovasi berbasis kebutuhan pengguna.</li>
                        <li>Menjadi mitra strategis pelanggan dalam transformasi digital.</li>
                        <li>Meningkatkan kompetensi dan profesionalisme SDM di bidang IT.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Bidang Layanan -->
    <section id="products" class="py-16">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center">Bidang Layanan</h3>
            <p class="text-center mt-2 text-sm text-gray-500">Kami menyediakan berbagai solusi IT yang siap
                mendukung bisnis Anda.</p>

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

                <a href="{{ route('katalog-produk') }}" wire:navigate
                    class="card bg-base-100 shadow hover:shadow-lg transition-all group">
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

    <!-- Kontak -->
    <section id="contact" class="py-16 bg-base-200">
        <div class="container mx-auto px-4 max-w-3xl text-center">
            <h3 class="text-3xl font-bold">Hubungi Kami</h3>
            <p class="mt-2 text-sm">Kami siap menjadi mitra teknologi Anda.</p>

            <div class="grid grid-cols-1 gap-8 mt-10 text-left">

                <a href="{{ $linkWaMe }}" target="_blank" class="w-full btn btn-success btn-lg gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone shrink-0 size-5">
                        <path
                            d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                    </svg>
                    Whatsapp Kami
                </a>
            </div>
        </div>
    </section>
</div>
