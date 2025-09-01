<?php

namespace App\Modules\Currency\Repositories;

use App\Exceptions\RepositoryException;
use App\Models\ExchangeRate;
use App\Modules\Currency\Contracts\CurrencyMapperInterface;
use App\Modules\Currency\Contracts\CurrencyRepositoryInterface;
use App\Modules\Currency\DTO\ExchangeRateDTO;
use Illuminate\Support\Facades\DB;

class ExchangeRateRepository implements CurrencyRepositoryInterface
{

    private CurrencyMapperInterface $currencyMapper;

    public function __construct(CurrencyMapperInterface $currencyMapper)
    {
        $this->currencyMapper = $currencyMapper;
    }

    public function saveRate(ExchangeRateDTO $rateDTO): void
    {
        try {
            ExchangeRate::updateOrCreate(
                ['base' => $rateDTO->base, 'code' => $rateDTO->code],
                ['rate' => $rateDTO->rate, 'fetched_at' => $rateDTO->fetchedAt]
            );
        } catch (\Exception $e) {
            throw new RepositoryException(
                "Failed to save rate for {$rateDTO->code}",
                0,
                $rateDTO->code,
                $e
            );
        }
    }

    public function saveRatesBatch(array $rateDTOS): void
    {
        DB::transaction(function () use ($rateDTOS) {
            foreach ($rateDTOS as $rateDTO) {
                $this->saveRate($rateDTO);
            }
        });
    }

    public function getRate(string $base, string $code): ?ExchangeRateDTO
    {
        $row = ExchangeRate::where(['base' => $base, 'code' => $code])->first();
        if (!$row) return null;
        return $this->currencyMapper->toDTO($row);
    }

    public function getAllRates(string $base): array
    {
        return ExchangeRate::where('base', $base)->get()
            ->map(fn($row) => $this->currencyMapper->toDTO($row))
            ->all();
    }
}
