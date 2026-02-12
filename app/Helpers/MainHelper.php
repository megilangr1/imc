<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Livewire;

class MainHelper
{
  public $bulan = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
  ];

  public function doAlert(Component $comp, $type = 'error', $message = 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !')
  {
    $comp->dispatch('toast', type: $type, message: $message);
  }

  public function dateFormatIndo($date)
  {
    $tanggal = date('d', strtotime($date));
    $bulan = (int) date('m', strtotime($date));
    $tahun = date('Y', strtotime($date));

    return $tanggal . ' ' . $this->bulan[$bulan] . ' ' . $tahun;
  }

  function terbilang(string $angka): string
  {
    $angka = trim($angka);

    if (!is_numeric($angka)) {
      return 'nol';
    }

    $angka = (int) $angka;

    $bilangan = [
      '',
      'satu',
      'dua',
      'tiga',
      'empat',
      'lima',
      'enam',
      'tujuh',
      'delapan',
      'sembilan',
      'sepuluh',
      'sebelas'
    ];

    if ($angka < 12) {
      return $bilangan[$angka];
    } elseif ($angka < 20) {
      return trim($bilangan[$angka - 10] . ' belas');
    } elseif ($angka < 100) {
      return trim(
        $bilangan[intdiv($angka, 10)] . ' puluh ' .
          $this->terbilang((string) ($angka % 10))
      );
    } elseif ($angka < 200) {
      return trim('seratus ' . $this->terbilang((string) ($angka - 100)));
    } elseif ($angka < 1000) {
      return trim(
        $bilangan[intdiv($angka, 100)] . ' ratus ' .
          $this->terbilang((string) ($angka % 100))
      );
    } elseif ($angka < 2000) {
      return trim('seribu ' . $this->terbilang((string) ($angka - 1000)));
    } elseif ($angka < 1000000) {
      return trim(
        $this->terbilang((string) intdiv($angka, 1000)) . ' ribu ' .
          $this->terbilang((string) ($angka % 1000))
      );
    } elseif ($angka < 1000000000) {
      return trim(
        $this->terbilang((string) intdiv($angka, 1000000)) . ' juta ' .
          $this->terbilang((string) ($angka % 1000000))
      );
    } elseif ($angka < 1000000000000) {
      return trim(
        $this->terbilang((string) intdiv($angka, 1000000000)) . ' milyar ' .
          $this->terbilang((string) ($angka % 1000000000))
      );
    } else {
      return 'angka terlalu besar';
    }
  }
}
