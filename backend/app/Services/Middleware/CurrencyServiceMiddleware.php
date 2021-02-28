<?php

declare(strict_types=1);

namespace App\Services\Middleware;

use App\Contracts\CurrencyService;

abstract class CurrencyServiceMiddleware
{
    /**
     * @var CurrencyService
     */
    protected ?CurrencyService $next = null;

    /**
     * Set next middleware after current.
     */
    public function setNext(CurrencyService $next): CurrencyService
    {
        $this->next = $next;

        return $next;
    }

    public function getConversionRate(
        string $currencyFrom,
        string $currencyTo,
    ): ?float {
        if (!$this->next) {
            return null;
        }

        return $this->next->getConversionRate($currencyFrom, $currencyTo);
    }
}
