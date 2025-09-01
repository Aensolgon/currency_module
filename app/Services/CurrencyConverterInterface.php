<?php

namespace App\Services;

interface CurrencyConverterInterface
{
    /**
     * Конвертация суммы
     */
    public function convert(float|int|string $amount, string $from, string $to): float;
}
