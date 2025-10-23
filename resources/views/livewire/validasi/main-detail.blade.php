<div class="flex flex-col gap-3">
    <x-main.page-header title="Rincian Permohonan Pengajuan Pencairan - {{ $detailData->nama_jenis_pengajuan ?? '-' }}">
        <a href="{{ route('verifikasi.index') }}" wire:navigate>
            <button type="button" class="btn btn-warning btn-sm">
                <x-icons.left />

                Daftar Pengajuan
            </button>
        </a>
    </x-main.page-header>

    <div class="w-full flex flex-col gap-1">
        <div
            class="rounded-lg border border-slate-200 flex flex-col gap-2 lg:gap-1 px-5 py-2 {{ $detailData->status_class }} animate-pulse">
            <h4 class="font-semibold">Status Verifikasi / Validasi Pengajuan :</h4>
            <div class="w-full flex items-end justify-end font-semibold">
                <button type="button" class="btn w-full border-0 sm:w-auto bg-neutral/90 text-info">
                    {{ $detailData->status_label }}
                </button>
            </div>
        </div>

        <div class="collapse collapse-arrow bg-base-100 border border-slate-300 shadow-lg">
            <input type="checkbox" name="collapse_keterangan_verifikasi" id="collapse_keterangan_verifikasi" />
            <div class="collapse-title font-semibold bg-sky-400/20">Detail Verifikasi / Validasi</div>
            <div class="collapse-content text-sm p-0 border-t-2 border-t-slate-300">
                <div class="grid grid-cols-12 text-sm md:text-sm p-0">
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-9 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Tanggal Pengajuan Verifikasi :</h4>
                        <div class="w-full flex items-end justify-end font-semibold">
                            {{ $detailData->tanggal_pengajuan_verifikasi != null ? date('d/M/Y', strtotime($detailData->tanggal_pengajuan_verifikasi)) : 'Belum Ada Informasi' }}
                        </div>
                    </div>
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-3 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Penginput : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nama_creator }}
                        </div>
                    </div>

                    <div class="col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2 bg-red-600/60">
                        <h4 class="font-semibold">
                            Keterangan Verifikator :
                        </h4>
                    </div>

                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Nama Verifikator : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nama_verifikator ?? 'Belum Ada Informasi' }}
                        </div>
                    </div>

                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Tanggal di-Verifikasi : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->tanggal_verifikasi != null ? date('d/M/Y', strtotime($detailData->tanggal_verifikasi)) : 'Belum Ada Informasi' }}
                        </div>
                    </div>

                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Catatan Verifikator : </h4>
                        <div class="w-full flex items-end justify-end font-semibold">
                            {{ $detailData->catatan_verifikator ?? 'Belum Ada Informasi' }}
                        </div>
                    </div>

                    <div class="col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2 bg-rose-600/60">
                        <h4 class="font-semibold">
                            Keterangan Validator :
                        </h4>
                    </div>

                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Nama Validator : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nama_validator ?? 'Belum Ada Informasi' }}
                        </div>
                    </div>

                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Tanggal di-Validasi : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->tanggal_validasi != null ? date('d/M/Y', strtotime($detailData->tanggal_validasi)) : 'Belum Ada Informasi' }}
                        </div>
                    </div>

                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Catatan Validator : </h4>
                        <div class="w-full flex items-end justify-end font-semibold">
                            {{ $detailData->catatan_validator ?? 'Belum Ada Informasi' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border border-slate-300 bg-base-100 w-full">
        <div class="card-body p-0 gap-0">
            <div
                class="card-title px-5 py-3 border-b border-b-slate-300 text-sm flex flex-col md:flex-row items-center justify-between gap-1">
                <div class="flex-auto w-full text-start">
                    Detail Informasi Kegiatan
                </div>

                <div class="w-full text-end">
                </div>
            </div>

            <div class="grid grid-cols-12 text-sm md:text-sm p-0">
                <div
                    class="col-span-12 sm:col-span-12 lg:col-span-9 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                    <h4 class="font-semibold">Satuan Kerja Perangkat Daerah :</h4>
                    <div class="w-full flex items-end justify-end font-semibold">
                        {{ $detailData->skpd->kode_skpd ?? '-' }} - {{ $detailData->skpd->nama_skpd ?? '-' }}
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-12 lg:col-span-3 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                    <h4 class="font-semibold">Penginput : </h4>
                    <div class="w-full flex items-end justify-end">
                        {{ $detailData->nama_creator }}
                    </div>
                </div>

                <div class="col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2 bg-sky-300/60">
                    <h4 class="font-semibold">
                        Detail Kegiatan :
                    </h4>
                </div>

                @if ($detailData->kegiatan != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Kegiatan : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->kegiatan }}
                        </div>
                    </div>
                @endif

                @if ($detailData->sub_kegiatan != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Sub Kegiatan : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->sub_kegiatan }}
                        </div>
                    </div>
                @endif

                @if ($detailData->pekerjaan != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Pekerjaan : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->pekerjaan }}
                        </div>
                    </div>
                @endif

                @if ($detailData->kode_rekening_belanja != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Kode Rekening Belanja : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->kode_rekening_belanja }}
                        </div>
                    </div>
                @endif

                @if ($detailData->nama_rekening_belanja != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Nama Rekening Belanja : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nama_rekening_belanja }}
                        </div>
                    </div>
                @endif

                @if ($detailData->sumber_dana != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Sumber Dana : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->sumber_dana }}
                        </div>
                    </div>
                @endif

                @if ($detailData->nomor_sp_spk != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Nomor SP / SPK : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nomor_sp_spk }}
                        </div>
                    </div>
                @endif

                @if ($detailData->lokasi != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Lokasi : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->lokasi }}
                        </div>
                    </div>
                @endif

                @if ($detailData->nomor_spm != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Nomor SPM : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nomor_spm }}
                        </div>
                    </div>
                @endif

                @if ($detailData->tanggal_spm != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Tanggal SPM : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ date('d/m/Y', strtotime($detailData->tanggal_spm)) }}
                        </div>
                    </div>
                @endif

                @if ($detailData->nominal != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Nominal : </h4>
                        <div class="w-full flex items-end justify-end">
                            Rp. {{ number_format($detailData->nominal, 0, ',', '.') }}
                        </div>
                    </div>
                @endif

                @if ($detailData->nama_pihak_ketiga != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Nama Pihak Ketiga : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nama_pihak_ketiga }}
                        </div>
                    </div>
                @endif

                @if ($detailData->kualifikasi != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Kualifikasi : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->kualifikasi }}
                        </div>
                    </div>
                @endif

                @if ($detailData->nomor_rekening != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Nomor Rekening : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nomor_rekening }}
                        </div>
                    </div>
                @endif

                @if ($detailData->nama_bank != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Nama Bank : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nama_bank }}
                        </div>
                    </div>
                @endif

                @if ($detailData->jangka_kontrak != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Jangka Kontrak : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->jangka_kontrak }}
                        </div>
                    </div>
                @endif

                @if ($detailData->tanggal_mulai_pekerjaan != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Tanggal Mulai Pekerjaan : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ date('d/m/Y', strtotime($detailData->tanggal_mulai_pekerjaan)) }}
                        </div>
                    </div>
                @endif

                @if ($detailData->tanggal_selesai_pekerjaan != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Tanggal Selesai Pekerjaan : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ date('d/m/Y', strtotime($detailData->tanggal_selesai_pekerjaan)) }}
                        </div>
                    </div>
                @endif

                {{-- Non Kontrak --}}
                @if ($detailData->bpdp_filename != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Bukti Pembayaran / Daftar Penerima : </h4>
                        <div class="w-full flex items-end justify-end">
                            @if ($detailData->bpdp_filename != null)
                                <a href="{{ route('private-file', ['folder' => $detailData->bpdp_folder, 'filename' => $detailData->bpdp_filename]) }}"
                                    target="_blank" class="btn btn-sm btn-neutral w-full sm:w-auto">
                                    Lihat File
                                </a>
                            @else
                                <button type="button" class="btn btn-sm btn-error">
                                    Belum Ada File
                                </button>
                            @endif

                        </div>
                    </div>
                @endif

                @if ($detailData->jenis_pembayaran != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Jenis Pembayaran : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->jenis_pembayaran }}
                        </div>
                    </div>
                @endif

                @if ($detailData->jenis_belanja != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Jenis Belanja : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->jenis_belanja }}
                        </div>
                    </div>
                @endif

                @if ($detailData->nama_bulan != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Pembayaran Bulan : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->nama_bulan }}
                        </div>
                    </div>
                @endif

                @if ($detailData->keterangan != null)
                    <div
                        class="col-span-12 sm:col-span-12 lg:col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                        <h4 class="font-semibold">Keterangan : </h4>
                        <div class="w-full flex items-end justify-end">
                            {{ $detailData->keterangan }}
                        </div>
                    </div>
                @endif

                <div class="col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2 bg-sky-300/60">
                    <h4 class="font-semibold">
                        Informasi Penanggung Jawab Kegiatan :
                    </h4>
                </div>
                <div
                    class="col-span-12 sm:col-span-6 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                    <h4 class="font-semibold">NIP PA / KPA : </h4>
                    <div class="w-full flex items-end justify-end">
                        {{ $detailData->nip_pa_kpa }}
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-6 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                    <h4 class="font-semibold">Nama PA / KPA : </h4>
                    <div class="w-full flex items-end justify-end">
                        {{ $detailData->nama_pa_kpa }}
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-6 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                    <h4 class="font-semibold">Jabatan PA / KPA : </h4>
                    <div class="w-full flex items-end justify-end">
                        {{ $detailData->jabatan_pa_kpa }}
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-6 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                    <h4 class="font-semibold">NIP PPK : </h4>
                    <div class="w-full flex items-end justify-end">
                        {{ $detailData->nip_ppk }}
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-6 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                    <h4 class="font-semibold">Nama PPK : </h4>
                    <div class="w-full flex items-end justify-end">
                        {{ $detailData->nama_ppk }}
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-6 lg:col-span-4 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                    <h4 class="font-semibold">Jabatan PPK : </h4>
                    <div class="w-full flex items-end justify-end">
                        {{ $detailData->jabatan_ppk }}
                    </div>
                </div>

                <div class="col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-1 bg-sky-300/60"></div>
            </div>

            <div
                class="card-actions text-xs font-semibold text-slate-600 bg-slate-200 rounded-b-lg px-5 py-2 border-t border-t-slate-300">
                Rincian Permohonan Pengajuan Pencairan - {{ $detailData->nama_jenis_pengajuan ?? '-' }}
            </div>
        </div>
    </div>

    <form wire:submit.prevent="actionForm" id="formValidasi" class="w-full">
        <div class="card border border-slate-300 bg-base-100 w-full">
            <div class="card-body p-0 gap-0">
                <div
                    class="card-title px-5 py-3 border-b border-b-slate-300 text-sm flex flex-col md:flex-row items-center justify-between gap-1">
                    <div class="flex-auto w-full text-start">
                        Daftar Dokumen Persyaratan
                    </div>
                </div>

                <div class="w-full flex flex-col text-sm md:text-sm p-0">
                    <div class="overflow-x-auto border-b border-b-slate-300">
                        <table
                            class="table table-zebra table-sm table-pin-rows table-pin-cols min-w-4xl md:min-w-full">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No.</th>
                                    <td>Nama Dokumen</td>
                                    <td class="text-center">File</td>
                                    @if ($detailData->status === 3)
                                        <th class="text-center" width="5%">Sesuai</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokumenState as $key => $item)
                                    <tr>
                                        <th class="text-center bg-slate-200">{{ $loop->iteration }}</th>
                                        <td>
                                            <div class="flex flex-col gap-2">
                                                <h6 class="underline underline-offset-4 text-sm">
                                                    {{ $item['title'] }}
                                                </h6>

                                                <div class="flex flex-col gap-1">
                                                    <div
                                                        class="btn btn-info btn-outline btn-xs btn-wide justify-start group">
                                                        <div class="group-hover:text-white">Status Verifikasi</div>
                                                        <div class="group-hover:text-white">:</div>
                                                        <div class="font-semibold">
                                                            @if ($detailData->status < 2)
                                                                Belum di-Validasi
                                                            @else
                                                                @if ($item['status_verifikasi'])
                                                                    <span
                                                                        class="text-info group-hover:text-white">Sesuai</span>
                                                                @else
                                                                    <span class="text-red-500">Tidak Sesuai</span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="btn btn-success btn-outline btn-xs btn-wide justify-start group">
                                                        <div class="group-hover:text-white">Status Validasi</div>
                                                        <div class="group-hover:text-white">:</div>
                                                        <div class="font-semibold">
                                                            @if ($detailData->status < 4)
                                                                Belum di-Validasi
                                                            @else
                                                                @if ($item['status_validasi'])
                                                                    <span
                                                                        class="text-success group-hover:text-white">Sesuai</span>
                                                                @else
                                                                    <span class="text-red-500">Tidak Sesuai</span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if ($item['filename'] != null)
                                                <a href="{{ route('private-file', ['folder' => $item['folder'], 'filename' => $item['filename']]) }}"
                                                    target="_blank" class="btn btn-xs btn-neutral w-full">
                                                    Lihat File
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-xs btn-warning w-full">
                                                    Tidak Ada File
                                                </button>
                                            @endif
                                        </td>
                                        @if ($detailData->status === 3)
                                            <th class="text-center">
                                                <div class="flex flex-col gap-2">
                                                    @if ($errors->has('verifyState.' . $item['uuid']))
                                                        <span class="text-neutral text-[10px] py-1 w-full bg-error">
                                                            PILIH NILAI !
                                                        </span>
                                                    @endif

                                                    <div class="flex items-center justify-center text-center gap-4">
                                                        <label for="sesuai_{{ $loop->iteration }}"
                                                            class="cursor-pointer">
                                                            <input type="radio"
                                                                wire:model.live="verifyState.{{ $item['uuid'] }}"
                                                                name="sesuai_{{ $loop->iteration }}"
                                                                id="sesuai_{{ $loop->iteration }}" value="1"
                                                                class="checkbox checkbox-success" required />
                                                            Sesuai
                                                        </label>

                                                        <label for="tidak_sesuai_{{ $loop->iteration }}"
                                                            class="cursor-pointer">
                                                            <input type="radio"
                                                                wire:model.live="verifyState.{{ $item['uuid'] }}"
                                                                name="sesuai_{{ $loop->iteration }}"
                                                                id="tidak_sesuai_{{ $loop->iteration }}"
                                                                value="0" class="checkbox checkbox-error" />
                                                            Tidak
                                                        </label>

                                                    </div>
                                                </div>
                                            </th>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($detailData->status === 3)
                    <div
                        class="card-title px-5 py-3 border-b border-b-slate-300 text-sm flex flex-col md:flex-row items-center justify-between gap-1 bg-warning">
                        <div class="flex-auto w-full text-start">
                            Rincian Validasi
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-3 text-sm md:text-sm px-5 py-3">
                        <div class="col-span-12 md:col-span-12 lg:col-span-12">
                            <label for="hasilValidasi"
                                class="block text-sm font-medium mb-2 {{ $errors->has('hasilValidasi') ? 'text-red-500' : '' }}">
                                Hasil Validasi :
                            </label>
                            <div class="relative">
                                <select wire:model="hasilValidasi" id="hasilValidasi" name="hasilValidasi"
                                    class="w-full select @error('hasilValidasi') select-error @enderror"
                                    aria-describedby="hasilValidasi-helper" placeholder="Masukan hasilValidasi..."
                                    autocomplete="false" required>
                                    <option value="">Pilih Hasil Validasi</option>
                                    <option value="1">VALID, LANJUTKAN VALIDASI</option>
                                    <option value="0">TOLAK, PENGAJUAN TIDAK SESUAI</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 end-6 {{ $errors->has('hasilValidasi') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
                                    <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" x2="12" y1="8" y2="12">
                                        </line>
                                        <line x1="12" x2="12.01" y1="16" y2="16">
                                        </line>
                                    </svg>
                                </div>
                            </div>
                            @error('hasilValidasi')
                                <p class="text-xs text-red-600 mt-1" id="hasilValidasi-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12">
                            <label for="catatanValidasi"
                                class="block text-sm font-medium mb-2 {{ $errors->has('catatanValidasi') ? 'text-red-500' : '' }}">
                                Catatan Validasi :
                            </label>
                            <div class="relative">
                                <textarea type="text" wire:model="catatanValidasi" id="catatanValidasi" name="catatanValidasi"
                                    class="w-full textarea @error('catatanValidasi') textarea-error @enderror"
                                    aria-describedby="catatanValidasi-helper" placeholder="Masukan Catatan Validasi..." autocomplete="false" required
                                    wire:loading.attr="disabled"></textarea>
                                <div
                                    class="absolute inset-y-0 end-0 {{ $errors->has('catatanValidasi') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
                                    <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" x2="12" y1="8" y2="12">
                                        </line>
                                        <line x1="12" x2="12.01" y1="16" y2="16">
                                        </line>
                                    </svg>
                                </div>
                            </div>
                            @error('catatanValidasi')
                                <p class="text-xs text-red-600 mt-1" id="catatanValidasi-helper">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-12">
                            <hr class="border-t-2 border-t-slate-300">
                        </div>

                        <div class="col-span-12 lg:col-span-12 flex flex-col gap-1">
                            <button type="button"
                                class="verify-btn btn btn-lg btn-block text-slate-300 bg-emerald-600/90 hover:bg-emerald-600 hover:text-white gap-3 text-sm lg:text-sm"
                                data-target="validasi.main-detail">
                                <x-icons.edit class="size-5" />
                                Validasi Pengajuan
                                <x-icons.edit class="size-5" />
                            </button>
                        </div>
                    </div>
                @endif

                <div class="card-actions text-xs font-semibold text-slate-600 bg-slate-200 rounded-b-lg px-5 py-2">
                    Daftar Dokumen Persyaratan Permohonan Pengajuan Pencairan -
                    {{ $detailData->nama_jenis_pengajuan ?? '-' }}
                </div>
            </div>
        </div>
    </form>
</div>

@push('js')
    <script>
        waitForLivewireReady(() => {
            document.addEventListener('click', (e) => {
                const btn = e.target.closest('.verify-btn');
                if (!btn) return;

                const form = document.querySelector('#formValidasi');
                if (!form) return;

                // 🔹 1. Jalankan HTML validation dulu
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                const compTarget = btn.dataset.target;

                // 🔹 2. Tampilkan konfirmasi SweetAlert
                doSwal(() => {
                    // 🔹 3. Kalau user konfirmasi, submit Livewire
                    form.dispatchEvent(new Event('submit', {
                        bubbles: true,
                        cancelable: true
                    }));
                }, {
                    title: "Validasi Permohonan?",
                    text: "Informasi Validasi Akan di-Simpan!",
                    icon: "question",
                    confirmButtonColor: "#4f46e5",
                    confirmButtonText: "Ya, Selesaikan!",
                });
            });
        });
    </script>
@endpush
