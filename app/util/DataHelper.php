<?php

namespace App\Util;

use DateTime;

class DateHelper
{
    public static function formatDate($dateString)
    {
        dd($dateString);
        $date = new DateTime($dateString);
        return $date->format('F d, Y'); // 'F' untuk nama bulan lengkap, 'd' untuk hari dua digit, 'Y' untuk tahun empat digit
    }
}
