<div class="flex flex-col gap-3">
    <x-main.page-header title="Daftar Formulir Pengajuan Pencairan">
        <a href="{{ route('pencairan.index') }}" wire:navigate>
            <button type="button" class="btn btn-error btn-sm">Kembali</button>
        </a>
    </x-main.page-header>

    <div class="w-full grid grid-cols-6 gap-3">
        <a href="{{ route('pencairan.barjas-kontrak') }}" wire:navigate class="col-span-6 md:col-span-3 lg:col-span-2">
            <div
                class="w-full h-full card bg-neutral-content text-neutral hover:bg-neutral/90 group hover:text-info transition-colors duration-300">
                <div class="card-body gap-0 justify-start">
                    <span>Formulir Pencairan</span>
                    <h2 class="card-title">LS Belanja Barang dan Jasa - Kontrak</h2>
                    <div class="card-actions justify-end mt-auto">
                        <button class="btn btn-sm group-hover:btn-info transition-colors duration-300">
                            Buka Formulir
                        </button>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('pencairan.barjas-non-kontrak') }}" wire:navigate
            class="col-span-6 md:col-span-3 lg:col-span-2">
            <div
                class="w-full h-full card bg-neutral-content text-neutral hover:bg-neutral/90 group hover:text-info transition-colors duration-300">
                <div class="card-body gap-0 justify-start">
                    <span>Formulir Pencairan</span>
                    <h2 class="card-title">LS Belanja Barang dan Jasa - Non Kontrak</h2>
                    <div class="card-actions justify-end mt-auto">
                        <button class="btn btn-sm group-hover:btn-info transition-colors duration-300">
                            Buka Formulir
                        </button>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('pencairan.hibah-bansos') }}" wire:navigate class="col-span-6 md:col-span-3 lg:col-span-2">
            <div
                class="w-full h-full card bg-neutral-content text-neutral hover:bg-neutral/90 group hover:text-info transition-colors duration-300">
                <div class="card-body gap-0 justify-start">
                    <span>Formulir Pencairan</span>
                    <h2 class="card-title">LS Hibah dan Bansos</h2>
                    <div class="card-actions justify-end mt-auto">
                        <button class="btn btn-sm group-hover:btn-info transition-colors duration-300">
                            Buka Formulir
                        </button>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('pencairan.tambah-uang') }}" wire:navigate class="col-span-6 md:col-span-3 lg:col-span-2">
            <div
                class="w-full h-full card bg-neutral-content text-neutral hover:bg-neutral/90 group hover:text-info transition-colors duration-300">
                <div class="card-body gap-0 justify-start">
                    <span>Formulir Pencairan</span>
                    <h2 class="card-title">Tambah Uang (TU)</h2>
                    <div class="card-actions justify-end mt-auto">
                        <button class="btn btn-sm group-hover:btn-info transition-colors duration-300">
                            Buka Formulir
                        </button>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('pencairan.tunjangan-kinerja') }}" wire:navigate
            class="col-span-6 md:col-span-3 lg:col-span-2">
            <div
                class="w-full h-full card bg-neutral-content text-neutral hover:bg-neutral/90 group hover:text-info transition-colors duration-300">
                <div class="card-body gap-0 justify-start">
                    <span>Formulir Pencairan</span>
                    <h2 class="card-title">Tunjangan Kinerja (TUKIN)</h2>
                    <div class="card-actions justify-end mt-auto">
                        <button class="btn btn-sm group-hover:btn-info transition-colors duration-300">
                            Buka Formulir
                        </button>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('pencairan.gaji-jkk-jkm-bpjs') }}" wire:navigate
            class="col-span-6 md:col-span-3 lg:col-span-2">
            <div
                class="w-full h-full card bg-neutral-content text-neutral hover:bg-neutral/90 group hover:text-info transition-colors duration-300">
                <div class="card-body gap-0 justify-start">
                    <span>Formulir Pencairan</span>
                    <h2 class="card-title">Gaji / JKK / JKM / BPJS</h2>
                    <div class="card-actions justify-end mt-auto">
                        <button class="btn btn-sm group-hover:btn-info transition-colors duration-300">
                            Buka Formulir
                        </button>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('pencairan.up-gu') }}" wire:navigate class="col-span-6 md:col-span-3 lg:col-span-2">
            <div
                class="w-full h-full card bg-neutral-content text-neutral hover:bg-neutral/90 group hover:text-info transition-colors duration-300">
                <div class="card-body gap-0 justify-start">
                    <span>Formulir Pencairan</span>
                    <h2 class="card-title">Uang Persediaan (UP) / Ganti Uang (GU)</h2>
                    <div class="card-actions justify-end mt-auto">
                        <button class="btn btn-sm group-hover:btn-info transition-colors duration-300">
                            Buka Formulir
                        </button>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
