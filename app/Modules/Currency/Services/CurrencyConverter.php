<?php

namespace App\Modules\Currency\Services;

use App\Exceptions\CurrencyException;
use App\Modules\Currency\Contracts\CurrencyConverterInterface;
use App\Modules\Currency\Contracts\CurrencyRepositoryInterface;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class CurrencyConverter implements CurrencyConverterInterface
{
    private CurrencyRepositoryInterface $repository;
    private string $baseCurrency;

    protected int $scale = 10;

    public function __construct(CurrencyRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->baseCurrency = config('currency.base', 'USD');
    }

    /**
     * @throws CurrencyException
     */
    public function convert(float|int|string $amount, string $from, string $to): float
    {
        try {
            $amount = (float)$amount;
            $from = strtoupper(trim($from));
            $to = strtoupper(trim($to));

            if ($from === $to) return $amount;

            $fromRateDTO = $this->repository->getRate($this->baseCurrency, $from);
            $toRateDTO = $this->repository->getRate($this->baseCurrency, $to);

            if (!$fromRateDTO) throw new CurrencyException("Rate for '{$from}' not found");
            if (!$toRateDTO) throw new CurrencyException("Rate for '{$to}' not found");

            $amountDecimal = BigDecimal::of((string)$amount);
            $fromRateDecimal = BigDecimal::of((string)$fromRateDTO->rate);
            $toRateDecimal = BigDecimal::of((string)$toRateDTO->rate);

            return $amountDecimal
                ->dividedBy($fromRateDecimal, $this->scale, RoundingMode::HALF_UP)
                ->multipliedBy($toRateDecimal)
                ->toFloat();
        } catch (CurrencyException $e) {
            throw new CurrencyException($e->getMessage());
        }
    }
}
