<?php

namespace App\Exceptions;

class ConversionException extends CurrencyException
{
    const CODE_RATE_NOT_FOUND = 3001;
    const CODE_INVALID_AMOUNT = 3002;

    public function __construct(string $message, int $code = self::CODE_RATE_NOT_FOUND, string $context = '', \Throwable $previous = null)
    {
        parent::__construct($message, $code, $context, $previous);
    }
}
