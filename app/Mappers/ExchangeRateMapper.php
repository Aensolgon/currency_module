<?php

namespace App\Mappers;

use App\DTO\ExchangeRateDTO;
use App\Models\ExchangeRate;

class ExchangeRateMapper
{
    public function toDTO(ExchangeRate $model): ExchangeRateDTO
    {
        return new ExchangeRateDTO(
            $model->base,
            $model->code,
            $model->rate,
            new \DateTimeImmutable($model->fetched_at)
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
