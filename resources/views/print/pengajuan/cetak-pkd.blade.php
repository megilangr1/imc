<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Resume Kontrak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
        }

        /* KOP SURAT */
        .kop-surat {
            width: 100%;
            text-align: center;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
            margin-bottom: 18px;
            letter-spacing: 1px;
        }

        .kop-surat-logo {
            float: left;
            width: 10%;
            height: auto;
        }

        .kop-surat-logo img {
            width: 80px;
        }

        .kop-surat-info {
            width: 100%;
            padding-left: 4px;
        }

        .kop-surat-info h1 {
            font-size: 18px;
            text-transform: uppercase;
        }

        .kop-surat-info h2 {
            font-size: 16px;
        }

        .kop-surat-info p {
            margin: 2px 0;
            font-size: 12px;
        }

        /* END KOP SURAT */

        .table {
            width: 100%;
            border-spacing: 0px;
            letter-spacing: 1px;
        }

        .text-center {
            text-align: center;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        h1 {
            margin: 0px;
            padding: 0px;
        }

        h2 {
            margin: 0px;
            padding: 0px;
        }

        h3 {
            margin: 0px;
            padding: 0px;
        }

        h4 {
            margin: 0px;
            padding: 0px;
        }

        h5 {
            margin: 0px;
            padding: 0px;
        }

        p {
            margin: 0px;
            padding: 0px;
        }

        .title {
            padding-bottom: 20;
        }

        .align-top {
            vertical-align: top !important;
        }

        .align-middle {
            vertical-align: middle !important;
        }

        td {
            font-size: 14px;
            padding: 4px 2px;
        }

        .tanda-tangan {
            position: fixed;
            bottom: 12px;
            right: 12px;
            text-align: center;
            width: 250px;
            line-height: 20px;
        }

        .text-xs {
            font-size: 10px;
        }

        .text-sm {
            font-size: 12px;
        }

        .box-black {
            padding: 4px 10px !important;
            border: 1px solid #000;
            background-color: #000 !important;
        }

        .box-black-sm {
            padding: 3px 8px !important;
            border: 1px solid #000;
            background-color: #000 !important;
        }

        .box-hollow {
            padding: 4px 8px !important;
            border: 1px solid #000;
            background-color: #FFF;
        }

        .box-hollow-sm {
            padding: 3px 8px !important;
            border: 1px solid #000;
            background-color: #FFF;
        }

        .p-2 {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <div class="kop-surat-logo">
            <div style="width: 100%; text-align: center; margin: 0 auto;">
                <img src="{{ public_path('img/LogoSukabumi.png') }}" alt="Logo">
            </div>
        </div>
        <div class="kop-surat-info">
            <div style="width: 100%; text-align: center;">
                <h2>PEMERINTAH KOTA SUKABUMI</h2>
                <h1>{{ $skpd['nama_skpd'] }}</h1>
                <p>Jl. Contoh Alamat No. 123, Sukabumi, Jawa Barat</p>
                <p>Telp: (0266) 123456 | Email: contoh@email.com | Website: www.sukabumikota.go.id</p>
            </div>
        </div>
    </div>

    <h4 class="text-center title">
        <span style="border-bottom: 2px solid #000; padding-bottom: 2px;">PENELITIAN KELENGKAPAN DOKUMEN</span>
    </h4>

    <table class="table" style="width: 90%; margin: 0 auto;">
        @foreach ($data as $item)
            @if ($item['value'] != null)
                <tr>
                    <td class="align-top text-sm" width="36%">
                        {{ $item['info'] }}
                    </td>
                    <td class="align-top text-sm text-center" width="4%">
                        :
                    </td>
                    <td class="align-top text-sm" width="60%">
                        @if ($item['bold'])
                            <b>{{ $item['value'] }}</b>
                        @else
                            {{ $item['value'] }}
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </table>

    <hr style="border-top: 1px; border-color: #000; width: 90%; margin: 10px auto;">

    <table border="1" class="table" style="width: 90%; margin: 0 auto; border: 2px;">
        <tr>
            <td class="text-center p-2">
                <h5 style="margin: 0px;">
                    Ada
                </h5>
            </td>
            <td class="text-center p-2">
                <h5 style="margin: 0px;">
                    Sesuai
                </h5>
            </td>
            <td class="text-start p-2">
                <h5 style="margin: 0px;">
                    Jenis Dokumen
                </h5>
            </td>
        </tr>
        @foreach ($dokumen as $item)
            <tr>
                <td class="align-top p-2 text-xs text-center" width="10%">
                    <span class="{{ !!$item['ada'] ? 'box-black' : 'box-hollow' }}">-</span>
                </td>
                <td class="align-top p-2 text-xs text-center" width="10%">
                    <span class="{{ !!$item['sesuai'] ? 'box-black' : 'box-hollow' }}">-</span>
                </td>
                <td class="align-top p-2 text-xs" width="60%">
                    {{ $item['jenis'] }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="p-2 text-end" colspan="3">
                <span class="box-black-sm">-</span> = Ya
                <span style="padding: 4px 0px;"></span>
                <span class="box-hollow-sm">-</span> = Tidak
            </td>
        </tr>
    </table>

    <div class="tanda-tangan">
        <p style="font-size: 14px;">Sukabumi, {{ $tanggal_cetak }}</p>
        <p style="font-size: 14px;">{{ $penanda_tangan['jabatan_ppk'] }}</p>
        <br><br><br>
        <h5 style="font-size: 14px;"><u>{{ $penanda_tangan['nama_ppk'] }}</u></h5>
        <p style="font-size: 14px">NIP. {{ $penanda_tangan['nip_ppk'] }}</p>
    </div>

</body>

</html>
