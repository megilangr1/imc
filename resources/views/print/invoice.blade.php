<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
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
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 0px;
            letter-spacing: 1px;
        }

        .kop-surat-logo {
            float: left;
            width: 36%;
            height: auto;
        }

        .kop-surat-logo img {
            width: 240px;
        }

        .kop-surat-info {
            width: 100%;
            padding-left: 4px;
        }

        .kop-surat-info h1 {
            font-size: 16px;
            text-transform: uppercase;
        }

        .kop-surat-info h2 {
            font-size: 12px;
        }

        .kop-surat-info p {
            margin: 2px 0;
            font-size: 10px;
        }

        /* END KOP SURAT */

        .table {
            width: 100%;
            border-spacing: 1px;
            letter-spacing: 1px;
            border-collapse: collapse;
        }

        .bt {
            border-top: 1px solid #000;
        }

        .bl {
            border-left: 1px solid #000;
        }

        .br {
            border-right: 1px solid #000;
        }

        .bb {
            border-bottom: 1px solid #000;
        }

        .text-left {
            text-align: left !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
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
            padding-top: 4px;
            padding-bottom: 4px;
        }

        .align-top {
            vertical-align: top !important;
        }

        .align-middle {
            vertical-align: middle !important;
        }

        td {
            font-size: 14px;
        }

        .embos {
            position: fixed;
            top: 45%;
            left: 14px;
            opacity: 0.15;
            font-size: 72px;
            color: #000;
            width: 100%;
            text-align: center;
        }

        .bot-left {
            position: fixed;
            bottom: 0;
            left: 0;
        }

        .text-base {
            font-size: 14px !important;
        }

        .text-sm {
            font-size: 12px !important;
        }

        .text-xs {
            font-size: 10px !important;
        }

        .text-xxs {
            font-size: 9px !important;
        }

        .font-semibold {
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <div class="kop-surat-logo">
            <div style="width: 100%; text-align: center; margin: 0 auto;">
                <img src="{{ public_path('img/logo-full.png') }}" alt="Logo">
            </div>
        </div>
        <div class="kop-surat-info">
            <div style="width: 100%; text-align: right;">
                <br>
                <h5 class="text-sm">Jl. Garuda No.55 Kp. Genteng Rt.03/02</h5>
                <h5 class="text-sm">Kec.Baros Kel.Baros Kota Sukabumi</h5>
                <h5 class="text-sm">Telpon : 085795774343</h5>
            </div>
        </div>
    </div>

    <h3 class="text-center title" style="font-size: 18px;">
        INVOICE
    </h3>

    <table class="table" style="width: 100%; margin: 0 auto;">
        <tr>
            <td class="align-top font-semibold text-sm" style="letter-spacing: 0px;" width="20%">
                Nomor Nota
            </td>
            <td class="align-top font-semibold text-sm text-center" style="letter-spacing: 0px;" width="5%">
                :
            </td>
            <td class="align-top text-sm" style="letter-spacing: 0px;" width="20%">
                {{ $data['nomor_nota'] ?? '-' }}
            </td>
            <td width="15%"></td>
            <td class="align-top font-semibold text-sm" style="letter-spacing: 0px;" width="15%">
                Nama Pemilik
            </td>
            <td class="align-top font-semibold text-sm text-center" style="letter-spacing: 0px;" width="5%">
                :
            </td>
            <td class="align-top text-sm" style="letter-spacing: 0px;" width="20%">
                {{ $data['pemilik_pekerjaan'] ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="align-top font-semibold text-sm" style="letter-spacing: 0px;" width="20%">
                Tempat dan Tanggal
            </td>
            <td class="align-top font-semibold text-sm text-center" style="letter-spacing: 0px;" width="5%">
                :
            </td>
            <td class="align-top text-sm" style="letter-spacing: 0px;" colspan="4">
                {{ $data['tempat_pekerjaan'] ?? '-' }}, {{ $data['tanggal_pekerjaan'] ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="align-top font-semibold text-sm" style="letter-spacing: 0px;" width="20%">
                Pekerjaan
            </td>
            <td class="align-top font-semibold text-sm text-center" style="letter-spacing: 0px;" width="5%">
                :
            </td>
            <td class="align-top text-sm" style="letter-spacing: 0px;" colspan="4">
                {{ $data['nama_pekerjaan'] ?? '-' }}
            </td>
        </tr>
    </table>

    <div style="padding: 10px 0px;"></div>

    <table class="table" style="width: 100%; margin: 0 auto;">
        <tr>
            <th class="align-middle text-center font-semibold text-sm bt bl"
                style="letter-spacing: 0px; padding: 3px 3px;" width="5%">
                No
            </th>
            <th class="align-middle text-center font-semibold text-sm bt bl"
                style="letter-spacing: 0px; padding: 3px 3px;" width="35%">
                Nama Produk
            </th>
            <th class="align-middle text-center font-semibold text-sm bt bl"
                style="letter-spacing: 0px; padding: 3px 3px;" width="20%">
                Banyak
            </th>
            <th class="align-middle text-center font-semibold text-sm bt bl"
                style="letter-spacing: 0px; padding: 3px 3px;" width="20%">
                Harga
            </th>
            <th class="align-middle text-center font-semibold text-sm bt bl br"
                style="letter-spacing: 0px; padding: 3px 3px;" width="20%">
                Jumlah
            </th>
        </tr>
        @foreach ($data['detail'] as $key => $item)
            <tr>
                <td class="align-middle text-center text-sm bt bl" style="letter-spacing: 0px; padding: 3px 3px;">
                    {{ $loop->iteration }}
                </td>
                <td class="align-middle text-center text-sm bt bl" style="letter-spacing: 0px; padding: 3px 3px;">
                    {{ $item['item'] ?? '-' }}
                </td>
                <td class="align-middle text-center text-sm bt bl" style="letter-spacing: 0px; padding: 3px 3px;">
                    {{ $item['jumlah'] ?? '-' }}
                </td>
                <td class="align-middle text-right text-sm bt bl" style="letter-spacing: 0px; padding: 3px 3px;">
                    <span style="float: left; padding-left: 3px;">Rp.</span>
                    {{ $item['harga'] ?? '-' }}
                </td>
                <td class="align-middle text-right text-sm bt bl br" style="letter-spacing: 0px; padding: 3px 3px;">
                    <span style="float: left; padding-left: 3px;">Rp.</span>
                    {{ $item['sub_total'] ?? '-' }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="align-middle text-right font-semibold text-sm bt bl bb"
                style="letter-spacing: 0px; padding: 3px 6px;" colspan="4">
                Total
            </td>
            <td class="align-middle text-right font-semibold text-sm bt bl bb br"
                style="letter-spacing: 0px; padding: 3px 3px;">
                <span style="float: left; padding-left: 3px;">Rp.</span>
                {{ $data['total_nominal'] ?? '-' }}
            </td>
        </tr>
    </table>

    <div class="bot-left text-xs" style="width: 100%">
        <table class="table" style="width: 100%; margin: 0 auto; padding-bottom: 30px;">
            <tr>
                <td class="align-top text-center text-sm" style="letter-spacing: 0px;" width="30%">
                    Tanda Terima
                    <br><br><br><br>
                    {{ $penanda_tangan['tanda_terima_pekerjaan'] ?? '-' }}
                </td>
                <td class="align-top text-center text-sm" style="letter-spacing: 0px;" width="40%"></td>
                <td class="align-top text-center text-sm" style="letter-spacing: 0px;" width="30%">
                    Hormat Kami
                    <br><br><br><br>
                    {{ $penanda_tangan['nama_pengguna'] ?? '-' }}
                </td>
            </tr>
        </table>

        <div style="border-bottom: 2px solid #000; padding-bottom: 4px;">
            <table class="table" style="width: 100%; margin: 0 auto;">
                <tr>
                    <td class="align-top text-right text-xxs" style="letter-spacing: 0px;" width="80%">
                        Tanggal Cetak
                    </td>
                    <td class="align-top text-center text-xxs" style="letter-spacing: 0px;" width="5%">
                        :
                    </td>
                    <td class="align-top text-right text-xxs" style="letter-spacing: 0px;">
                        {{ $info_cetak['tanggal_cetak'] ?? '-' }}
                    </td>
                </tr>
            </table>
        </div>

        <p class="text-center" style="padding-top: 4px;">Di-Keluarkan Oleh Aplikasi IMC-POS </p>
    </div>
</body>

</html>
