<?php

declare(strict_types=1);

namespace App\Helper;

use NumberFormatter;

/**
 * Class FormatHelper
 * @package App\Helper
 */
class FormatHelper
{
    /**
     * @param string $path
     * @return string
     */
    public static function nameFromPath(string $path): string
    {
        return \str_replace(['/', 'import', '.json'], '', $path);
    }

    /**
     * @param float $number
     * @return string
     */
    public static function toMoney(float $number): string
    {
        $numberFormatter = new NumberFormatter('en-US', NumberFormatter::CURRENCY, '%n');
        $formatted = $numberFormatter->formatCurrency($number, 'USD');

        return $formatted;
    }
}
