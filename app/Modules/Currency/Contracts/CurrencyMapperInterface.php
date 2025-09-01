<?php

namespace App\Modules\Currency\Contracts;

use App\Models\ExchangeRate;
use App\Modules\Currency\DTO\ExchangeRateDTO;

interface CurrencyMapperInterface
{
    public function toDTO(ExchangeRate $model): ExchangeRateDTO;
}
