<?php

namespace App\Helpers;

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

  public function doAlert(Component $comp, $type = "error", $message = "Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !")
  {
    $comp->dispatch('toast', type: $type, message: $message);
  }
}
