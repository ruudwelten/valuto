<?php

declare(strict_types=1);

namespace App\Contracts;

interface CurrencyService
{
    /**
     * Get conversion rate from service.
     *
     * @param  string  $currencyFrom
     * @param  string  $currencyTo
     * @return ?float
     */
    public function getConversionRate(
        string $currencyFrom,
        string $currencyTo,
    ): ?float;

    /**
     * Set time limit for requests.
     *
     * @param  int     $milliseconds
     * @return CurrencyService
     */
    public function setTimeout(int $milliseconds): CurrencyService;

    /**
     * Set number of retries for requests.
     *
     * @param  int     $retries
     * @return CurrencyService
     */
    public function setRetries(int $retries): CurrencyService;
}
