<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            \App\Repositories\CurrencyRepositoryInterface::class,
            \App\Repositories\ExchangeRateRepository::class
        );

        $this->app->singleton(
            \App\Services\CurrencyApiClientInterface::class,
            \App\Services\FreeCurrencyApiClient::class
        );

        $this->app->singleton(
            \App\Services\CurrencyConverterInterface::class,
            \App\Services\CurrencyConverter::class
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
