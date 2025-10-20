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
            width: 20%;
            height: auto;
        }

        .kop-surat-logo img {
            width: 80px;
        }

        .kop-surat-info {
            width: 100%;
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
            padding-top: 15px;
            padding-bottom: 35px;
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

    <h3 class="text-center title">
        <span style="border-bottom: 2px solid #000; padding-bottom: 2px;">RESUME</span>
    </h3>

    <table class="table" style="width: 90%; margin: 0 auto;">
        @foreach ($data as $item)
            @if ($item['value'] != null)
                <tr>
                    <td class="align-top" width="36%">
                        {{ $item['info'] }}
                    </td>
                    <td class="align-top text-center" width="4%">
                        :
                    </td>
                    <td class="align-top" width="60%">
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

    <div class="tanda-tangan">
        <p style="font-size: 14px;">Sukabumi, {{ $tanggal_cetak }}</p>
        <p style="font-size: 14px;">{{ $penanda_tangan['jabatan_ppk'] }}</p>
        <br><br><br>
        <h5 style="font-size: 14px;"><u>{{ $penanda_tangan['nama_ppk'] }}</u></h5>
        <p style="font-size: 14px">NIP. {{ $penanda_tangan['nip_ppk'] }}</p>
    </div>

</body>

</html>
