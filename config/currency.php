<?php

return [
    'base' => env('CURRENCY_BASE', 'USD'),
    'freecurrencyapi' => [
        'url' => env('FREECURRENCYAPI_URL', 'https://api.freecurrencyapi.com/v1'),
        'key' => env('FREECURRENCYAPI_KEY'),
        // Ограничитель: пауза между запросами (мс), если будете батчить
        'throttle_ms' => 0,
    ],
];
