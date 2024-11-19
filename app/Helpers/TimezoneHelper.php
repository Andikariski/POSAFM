<?php

use Carbon\Carbon;

class TimeHelper
{
    const TIMEZONE_WIB = 'Asia/Jakarta';
    const TIMEZONE_WITA = 'Asia/Makassar';
    const TIMEZONE_WIT = 'Asia/Jayapura';

    public static function getCurrentHour($timezone = null)
    {
        if (!$timezone) {
            $timezone = auth()->check() ? auth()->user()->timezone : self::TIMEZONE_WIT;
        }

        return Carbon::now()->setTimezone($timezone)->hour;
    }

    public static function formatTimeForDisplay($datetime, $timezone = null)
    {
        if (!$timezone) {
            $timezone = auth()->check() ? auth()->user()->timezone : self::TIMEZONE_WIT;
        }

        return Carbon::parse($datetime)->setTimezone($timezone)->format('H:i');
    }
}
