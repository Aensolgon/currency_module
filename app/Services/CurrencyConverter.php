<?php

namespace App\Services;

use App\Repositories\CurrencyRepositoryInterface;
use App\Exceptions\CurrencyException;

class CurrencyConverter implements CurrencyConverterInterface
{
    private CurrencyRepositoryInterface $repository;

    public function __construct(CurrencyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws CurrencyException
     */
    public function convert(float|int|string $amount, string $from, string $to): float
    {
        $amount = (float)$amount;
        $from = strtoupper(trim($from));
        $to = strtoupper(trim($to));
        $base = config('currency.base', 'USD');

        if ($from === $to) return $amount;

        $fromRateDTO = $this->repository->getRate($base, $from);
        $toRateDTO = $this->repository->getRate($base, $to);

        if (!$fromRateDTO) throw new CurrencyException("Rate for '{$from}' not found");
        if (!$toRateDTO) throw new CurrencyException("Rate for '{$to}' not found");

        return round(($amount / $fromRateDTO->rate) * $toRateDTO->rate, 2);
    }
}
