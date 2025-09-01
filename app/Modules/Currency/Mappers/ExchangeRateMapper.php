<?php

namespace App\Modules\Currency\Mappers;

use App\Models\ExchangeRate;
use App\Modules\Currency\Contracts\CurrencyMapperInterface;
use App\Modules\Currency\DTO\ExchangeRateDTO;
use Illuminate\Support\Carbon;

class ExchangeRateMapper implements CurrencyMapperInterface
{
    public function toDTO(ExchangeRate $model): ExchangeRateDTO
    {
        return new ExchangeRateDTO(
            $model->base,
            $model->code,
            $model->rate,
            new Carbon($model->fetched_at)
        );
    }

    public function toModel(ExchangeRateDTO $dto, ?ExchangeRate $model = null): ExchangeRate
    {
        $model = $model ?? new ExchangeRate();

        $model->base = $dto->base;
        $model->code = $dto->code;
        $model->rate = $dto->rate;
        $model->fetched_at = $dto->fetchedAt->format('Y-m-d H:i:s');

        return $model;
    }
}
