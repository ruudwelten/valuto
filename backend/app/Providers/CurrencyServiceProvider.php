<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\CurrencyService;
use App\Services\FccaCurrencyService;
use App\Services\KowabungaCurrencyService;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register currency services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CurrencyService::class, function ($app) {
            $currencyService = new FccaCurrencyService();
            $currencyService
                ->setTimeout(500)
                ->setRetries(0)

                ->setNext(new KowabungaCurrencyService())
                ->setTimeout(3000)
                ->setRetries(3);

            return $currencyService;
        });
    }

    /**
     * Bootstrap currency services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
