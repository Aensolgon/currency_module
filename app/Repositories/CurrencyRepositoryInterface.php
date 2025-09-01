<?php

namespace App\Repositories;

use App\DTO\ExchangeRateDTO;
use App\Exceptions\RepositoryException;

interface CurrencyRepositoryInterface
{
    /**
     * Сохраняет один курс валюты
     *
     * @param ExchangeRateDTO $rateDTO
     * @throws RepositoryException
     */
    public function saveRate(ExchangeRateDTO $rateDTO): void;

    /**
     * Сохраняет несколько курсов валют в одной транзакции
     *
     * @param ExchangeRateDTO[] $rateDTOS
     * @throws RepositoryException
     */
    public function saveRatesBatch(array $rateDTOS): void;

    /**
     * Получает курс по базовой и целевой валюте
     *
     * @param string $base
     * @param string $code
     * @return ExchangeRateDTO|null
     */
    public function getRate(string $base, string $code): ?ExchangeRateDTO;

    /**
     * Получает все курсы относительно базовой валюты
     *
     * @param string $base
     * @return ExchangeRateDTO[]
     */
    public function getAllRates(string $base): array;
}
