<?php

namespace App\DTO;

class ExchangeRateDTO
{
    public string $base;
    public string $code;
    public float $rate;
    public \DateTimeImmutable $fetchedAt;

    public function __construct(string $base, string $code, float $rate, \DateTimeImmutable $fetchedAt)
    {
        $this->base = $base;
        $this->code = $code;
        $this->rate = $rate;
        $this->fetchedAt = $fetchedAt;
    }
}
