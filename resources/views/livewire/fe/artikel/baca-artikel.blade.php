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

    <section id="article" class="container max-w-4xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 items-center justify-center gap-8">
            <div class="w-full flex flex-col gap-2">
                <h1 class="text-2xl font-semibold text-gray-900 mt-1">
                    {{ $detailData->judul }}
                </h1>

                <div>
                    <span class="text-sm text-gray-500">
                        {{ $detailData->desc ?? '-' }}
                    </span>
                </div>
            </div>

            <div class="w-full mx-auto">
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ route('public-file.view', ['folder' => $detailData->folder, 'filename' => $detailData->filename]) }}"
                        alt="{{ $detailData->nama_produk }}" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="border-t pt-4 text-gray-700 leading-relaxed">
                {!! nl2br($detailData->content) !!}
            </div>
        </div>
    </section>

    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
