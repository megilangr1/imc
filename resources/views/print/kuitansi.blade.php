<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi</title>
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
        KUITANSI
    </h3>

    <div style="padding: 10px 0px;"></div>

    <table class="table" style="width: 100%; margin: 0 auto;">
        <tr>
            <td class="align-top font-semibold text-base" style="letter-spacing: 0px; padding: 8px 0px;" width="20%">
                No
            </td>
            <td class="align-top font-semibold text-base text-center" style="letter-spacing: 0px; padding: 8px 0px;"
                width="5%">
                :
            </td>
            <td class="align-top text-base" style="letter-spacing: 0px; padding: 8px 0px;" colspan="4">
                {{ $data['nomor_nota'] }}
            </td>
        </tr>
        <tr>
            <td class="align-top font-semibold text-base" style="letter-spacing: 0px; padding: 8px 0px;" width="20%">
                Uang Sebesar
            </td>
            <td class="align-top font-semibold text-base text-center" style="letter-spacing: 0px; padding: 8px 0px;"
                width="5%">
                :
            </td>
            <td class="align-top text-base" style="letter-spacing: 0px; padding: 8px 0px;" colspan="4">
                {{ $data['total_nominal_terbilang'] ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="align-top font-semibold text-base" style="letter-spacing: 0px; padding: 8px 0px;" width="20%">
                Pembayaran
            </td>
            <td class="align-top font-semibold text-base text-center" style="letter-spacing: 0px; padding: 8px 0px;"
                width="5%">
                :
            </td>
            <td class="align-top text-base" style="letter-spacing: 0px; padding: 8px 0px;" colspan="4">
                {{ $data['nama_pekerjaan'] ?? '-' }}
            </td>
        </tr>
    </table>

    <div style="padding: 10px 0px;"></div>


    <div class="bot-left text-xs" style="width: 100%">
        <table class="table" style="width: 100%; margin: 0 auto; padding-bottom: 30px;">
            <tr>
                <td class="align-top text-center text-base" style="letter-spacing: 0px;" width="30%">
                    &ensp;
                    <br><br><br><br>
                    Rp. {{ $data['total_nominal'] ?? '-' }}
                </td>
                <td class="align-top text-center text-sm" style="letter-spacing: 0px;" width="40%"></td>
                <td class="align-top text-center text-sm" style="letter-spacing: 0px;" width="30%">
                    {{ $data['tempat_pekerjaan'] ?? '-' }}, {{ $data['tanggal_pekerjaan'] ?? '-' }}
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
