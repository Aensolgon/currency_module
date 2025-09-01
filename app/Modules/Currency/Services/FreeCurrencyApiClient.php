<?php

namespace App\Modules\Currency\Services;

use App\Exceptions\ApiException;
use App\Modules\Currency\Contracts\CurrencyApiClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class FreeCurrencyApiClient implements CurrencyApiClientInterface
{
    private Client $client;
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('currency.freecurrencyapi.url'), '/');
        $this->apiKey = (string) config('currency.freecurrencyapi.api_key');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 15,
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws ApiException
     */
    public function fetchCurrencies(): array
    {
        try {
            $resp = $this->client->get('/v1/currencies', ['query' => ['apikey' => $this->apiKey]]);
            $json = json_decode((string)$resp->getBody(), true);
            return $json['data'] ?? [];
        } catch (\Exception $e) {
            Log::error('Failed to fetch currencies', ['exception' => $e]);
            throw new ApiException("Failed to fetch currencies", 0, $e);
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiException
     */
    public function fetchLatestRates(string $base, array $codes = []): array
    {
        try {
            $query = ['apikey' => $this->apiKey, 'base_currency' => strtoupper($base)];
            if (!empty($codes)) {
                $query['currencies'] = implode(',', array_map('strtoupper', $codes));
            }

            $resp = $this->client->get('/v1/latest', ['query' => $query]);
            $json = json_decode((string)$resp->getBody(), true);
            return $json['data'] ?? [];
        } catch (\Exception $e) {
            Log::error('Failed to fetch latest rates', ['exception' => $e]);
            throw new ApiException("Failed to fetch latest rates", 0, $e);
        }
    }
}
