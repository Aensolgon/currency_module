<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use App\Services\CurrencyConverter;
use App\Services\FreeCurrencyApiClient;

class CurrencyRateController extends Controller
{
    public function index(CurrencyConverter $currencyConverter)
    {
        $base = config('currency.base', 'USD');

        $currencies = ExchangeRate::query()
            ->where('base', $base)
            ->orderBy('code')
            ->get();

        return view('admin.currency-rates.index', compact('currencies', 'base'));
    }
}
