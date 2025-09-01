<?php

namespace App\Modules\Currency\DTO;


use Illuminate\Support\Carbon;

class ExchangeRateDTO
{
    public string $base;
    public string $code;
    public float $rate;
    public Carbon $fetchedAt;

    public function __construct(string $base, string $code, float $rate, Carbon $fetchedAt)
    {
        $this->base = $base;
        $this->code = $code;
        $this->rate = $rate;
        $this->fetchedAt = $fetchedAt;
    }
}
