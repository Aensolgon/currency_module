<?php

namespace App\Console\Commands;

use App\DTO\ExchangeRateDTO;
use App\Exceptions\ApiException;
use App\Exceptions\RepositoryException;
use App\Exceptions\CurrencyException;
use App\Repositories\CurrencyRepositoryInterface;
use App\Services\CurrencyApiClientInterface;
use App\Models\Currency;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class RefreshExchangeRate extends Command
{
    protected $signature = 'currency:refresh';
    protected $description = 'Fetch latest currency rates from FreeCurrencyAPI and store to DB';

    private CurrencyApiClientInterface $apiClient;
    private CurrencyRepositoryInterface $repository;

    public function __construct(
        CurrencyApiClientInterface $apiClient,
        CurrencyRepositoryInterface $repository
    ) {
        parent::__construct();
        $this->apiClient = $apiClient;
        $this->repository = $repository;
    }

    public function handle(): int
    {
        $base = config('currency.base', 'USD');
        $now = CarbonImmutable::now();

        try {
            $codes = Currency::pluck('code')->all();
            $this->info("Fetching latest rates from FreeCurrencyAPI...");
            $rates = $this->apiClient->fetchLatestRates($base, $codes);

            if (empty($rates)) {
                $this->warn("No rates received from API.");
                return 1;
            }

            $currencyRates = [];
            foreach ($rates as $code => $rate) {
                $currencyRates[] = new ExchangeRateDTO($base, $code, (float)$rate, $now);
            }

            try {
                // Массовое сохранение в одной транзакции
                $this->repository->saveRatesBatch($currencyRates);

                // Вывод успешных операций
                foreach ($currencyRates as $currencyRate) {
                    $this->info("✅ [SUCCESS] {$currencyRate->code}: {$currencyRate->rate}");
                }
            } catch (RepositoryException $e) {
                $this->error($e->__toString());
                return 1;
            }

            $this->info("All done. Base currency: {$base}");

        } catch (ApiException|CurrencyException $e) {
            $this->error($e->__toString());
            return 1;
        } catch (\Exception $e) {
            $this->error("[UNEXPECTED] " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
