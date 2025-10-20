<div class="flex flex-col gap-3">
    <x-main.page-header title="Rincian Permohonan Pengajuan Pencairan - {{ $detailData->nama_jenis_pengajuan ?? '-' }}">
        <a href="{{ route('pencairan.index') }}" wire:navigate>
            <button type="button" class="btn btn-warning btn-sm">
                <x-icons.left />

                Daftar Pengajuan
            </button>
        </a>
    </x-main.page-header>

    <div class="card border border-slate-300 bg-base-100 w-full">
        <div class="card-body p-0 gap-0">
            <div
                class="card-title px-5 py-3 border-b border-b-slate-300 text-sm flex flex-col md:flex-row items-center justify-between gap-1">
                <div class="flex-auto w-full text-start">
                    Detail Informasi Kegiatan
                </div>

                <div class="w-full text-end">
                    <button type="button" class="btn bg-neutral text-white btn-xs" wire:click="doEdit">
                        <x-icons.edit />

                        Ubah Informasi Kegiatan
                    </button>
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

                <div class="col-span-12 border border-slate-200 flex flex-col gap-1 px-3 py-2">
                    <a href="{{ $cetakResumeUrl }}" target="_blank"
                        class="btn btn-lg btn-block bg-primary/60 hover:bg-primary hover:text-white gap-3">
                        <x-icons.print class="size-5" />
                        Cetak Resume Kegiatan
                        <x-icons.print class="size-5" />
                    </a>
                </div>

            </div>

            <div
                class="card-actions text-xs font-semibold text-slate-600 bg-slate-200 rounded-b-lg px-5 py-2 border-t border-t-slate-300">
                Rincian Permohonan Pengajuan Pencairan - {{ $detailData->nama_jenis_pengajuan ?? '-' }}
            </div>
        </div>
    </div>

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
                    <table class="table table-zebra table-sm table-pin-rows table-pin-cols min-w-4xl md:min-w-full">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No.</th>
                                <td>Nama Dokumen</td>
                                <td class="text-center">File</td>
                                <td class="text-center">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumenState as $key => $item)
                                <tr>
                                    <th class="text-center bg-slate-200">{{ $loop->iteration }}</th>
                                    <td>
                                        <div class="flex flex-col gap-2">
                                            <h6 class="underline underline-offset-4 text-sm">{{ $item['title'] }}
                                            </h6>

                                            <div class="flex flex-col gap-1">
                                                <div class="w-full flex items-center justify-center gap-2">
                                                    <div>Status Dokumen</div>
                                                    <div>:</div>
                                                    <div class="flex-auto font-semibold">
                                                        {{ $item['status_label'] }}
                                                    </div>
                                                </div>

                                                <div class="w-full flex items-center justify-center gap-2">
                                                    <div>Catatan Verifikator</div>
                                                    <div>:</div>
                                                    <div class="flex-auto">
                                                        {{ $item['catatan_verifikator'] }}
                                                    </div>
                                                </div>

                                                <div class="w-full flex items-center justify-center gap-2">
                                                    <div>Catatan Validator</div>
                                                    <div>:</div>
                                                    <div class="flex-auto">
                                                        {{ $item['catatan_validator'] }}
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
                                            <button type="button" class="btn btn-xs btn-error w-full">
                                                Belum Ada File
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button wire:click="openUploadModal('{{ $key }}')"
                                            class="btn btn-xs btn-primary w-full">
                                            Upload
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-actions text-xs font-semibold text-slate-600 bg-slate-200 rounded-b-lg px-5 py-2">
                Rincian Permohonan Pengajuan Pencairan - {{ $detailData->nama_jenis_pengajuan ?? '-' }}
            </div>
        </div>
    </div>

    {{-- Modal Upload --}}
    <div>
        <input type="checkbox" id="modal_upload" class="modal-toggle" wire:model.live="modalUpload" />
        <div class="modal modal-bottom sm:modal-middle" role="dialog">
            <div class="modal-box flex flex-col p-0 sm:w-[70vw] sm:max-w-full">
                <div class="flex flex-col gap-1 px-4 py-3">
                    <h3 class="text-sm font-bold">UPLOAD {{ $dokumenState[$activeState]['title'] ?? '-' }}</h3>
                    <span class="text-xs underline underline-offset-4 font-semibold">
                        - Silahkan Pilih File Yang Akan di-Upload -
                    </span>
                </div>
                <hr class="border-t border-t-slate-300">

                <form wire:submit="uploadFile">
                    <div class="flex flex-col gap-2 p-4">
                        <div class="relative">
                            <input type="file" wire:model="fileState" id="fileState" name="fileState"
                                class="w-full file-input @error('fileState') file-input-error @enderror"
                                aria-describedby="fileState-helper"
                                placeholder="Masukan Bukti Pembayaran / Daftar Penerima..." autocomplete="false"
                                accept=".jpg,.jpeg,.png,.pdf" required>
                            <div
                                class="absolute inset-y-0 end-0 {{ $errors->has('fileState') ? 'flex' : 'hidden' }} items-center pointer-events-none pe-3">
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
                        <div wire:loading wire:target="fileState" class="text-sm text-blue-500 mt-1">
                            Memeriksa File...
                        </div>
                        @error('fileState')
                            <p class="text-xs text-red-600 mt-1" id="fileState-helper">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="px-4 py-2 border-t border-t-slate-300">
                        <button type="submit" class="btn btn-neutral w-full"
                            {{ $errors->has('fileState') || $fileState == null ? 'disabled' : '' }}
                            wire:loading.attr="disabled" wire:target="fileState">
                            Upload Dokumen
                        </button>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="modal_upload">Close</label>
        </div>
    </div>

</div>
