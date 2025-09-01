<?php

namespace App\Helpers;

class PeriodHelper
{
    public static function periodsToMask(array $periods): int
    {
        $mask = 0;
        foreach ($periods as $p) {
            $p = (int) $p;
            if ($p >= 1 && $p <= 16) {
                $mask |= (1 << ($p - 1));
            }
        }
        return $mask;
    }

    public static function maskToPeriods(int $mask): array
    {
        $periods = [];
        for ($i = 0; $i < 16; $i++) {
            if (($mask & (1 << $i)) !== 0) {
                $periods[] = $i + 1;
            }
        }
        return $periods;
    }

    public static function maskHasPeriod(int $mask, int $period): bool
    {
        if ($period < 1 || $period > 16) return false;
        return (($mask & (1 << ($period - 1))) !== 0);
    }
}
