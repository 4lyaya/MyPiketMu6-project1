<?php

use Carbon\Carbon;

if (!function_exists('id_date')) {
    /**
     * Format tanggal dengan locale Indonesia.
     *
     * @param  string|\DateTimeInterface  $date
     * @param  string|null  $format
     * @return string
     */
    function id_date($date, $format = null)
    {
        $fmt = $format ?: session('date_format', 'd-m-Y');
        return Carbon::parse($date)->locale('id')->translatedFormat($fmt);
    }
}
