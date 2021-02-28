<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CurrencyService;
use App\Services\Middleware\CurrencyServiceMiddleware;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FccaCurrencyService extends CurrencyServiceMiddleware implements CurrencyService
{
    private $retries = 3;

    private $timeout = 3000;

    private $endpoint = 'https://free.currconv.com/api/v7/convert?q=%s_%s&compact=ultra&apiKey=%s';

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
    ): ?float {
        $requestUri = sprintf($this->endpoint, $currencyFrom, $currencyTo, env('API_KEY_FCCA'));

        $response = $this->request($requestUri);

        if (
            is_null($response) ||
            !isset($response[$currencyFrom . '_' . $currencyTo])
        ) {
            if (!is_null($this->next)) {
                return $this->next->getConversionRate($currencyFrom, $currencyTo);
            }
            return null;
        }

        return $response[$currencyFrom . '_' . $currencyTo];
    }

    private function request(string $requestUri, ?int $retries = null): ?Response
    {
        if (is_null($retries)) {
            $retries = $this->retries;
        }

        $response = Http::timeout($this->timeout / 1000)->get($requestUri);

        if ($response->failed() && $retries > 0) {
            $response = $this->request($requestUri, $retries - 1);
        }

        if ($response->failed()) {
            return null;
        }

        return $response;
    }

    /**
     * Set time limit for requests.
     *
     * @param  int     $milliseconds
     * @return CurrencyService
     */
    public function setTimeout(int $milliseconds): CurrencyService
    {
        $this->timeout = $milliseconds;

        return $this;
    }

    /**
     * Set number of retries for requests.
     *
     * @param  int     $retries
     * @return CurrencyService
     */
    public function setRetries(int $retries): CurrencyService
    {
        $this->retries = $retries;

        return $this;
    }
}
