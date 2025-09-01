<?php

namespace App\Modules\Currency\Contracts;

interface CurrencyConverterInterface
{
    /**
     * Конвертация суммы
     */
    public function convert(float|int|string $amount, string $from, string $to): float;
}
