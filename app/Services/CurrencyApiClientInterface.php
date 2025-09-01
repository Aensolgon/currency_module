<?php

namespace App\Services;

interface CurrencyApiClientInterface
{
    /**
     * Получить список валют
     * @return array [code => ['name' => ..., 'symbol' => ...]]
     */
    public function fetchCurrencies(): array;

    /**
     * Получить последние курсы
     * @param string $base
     * @param array $codes
     * @return array [code => rate]
     */
    public function fetchLatestRates(string $base, array $codes = []): array;
}
