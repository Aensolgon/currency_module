<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected string $context = '';

    public function __construct(
        string $message = "",
        int $code = 0,
        string $context = '',
        ?Exception $previous = null
    ) {
        $this->context = $context;
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        $prevClass = $this->getPrevious() ? get_class($this->getPrevious()) : 'N/A';
        $prevMsg   = $this->getPrevious() ? $this->getPrevious()->getMessage() : 'N/A';

        return "❌ [ApiException]; Code: {$this->code}; \n\n Context: {$this->context}; \n\n Message: {$this->message}; \n\n Previous: {$prevClass}: {$prevMsg}";
    }
}
