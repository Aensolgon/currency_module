<?php

namespace App\Providers;

use App\Modules\Currency\Contracts\CurrencyApiClientInterface;
use App\Modules\Currency\Contracts\CurrencyConverterInterface;
use App\Modules\Currency\Contracts\CurrencyMapperInterface;
use App\Modules\Currency\Contracts\CurrencyRepositoryInterface;
use App\Modules\Currency\Mappers\ExchangeRateMapper;
use App\Modules\Currency\Repositories\ExchangeRateRepository;
use App\Modules\Currency\Services\CurrencyConverter;
use App\Modules\Currency\Services\FreeCurrencyApiClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            CurrencyRepositoryInterface::class,
            ExchangeRateRepository::class
        );

        $this->app->singleton(
            CurrencyApiClientInterface::class,
            FreeCurrencyApiClient::class
        );

        $this->app->singleton(
            CurrencyConverterInterface::class,
            CurrencyConverter::class
        );

        $this->app->singleton(
            CurrencyMapperInterface::class,
            ExchangeRateMapper::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
