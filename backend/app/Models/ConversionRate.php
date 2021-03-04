<?php

declare(strict_types=1);

namespace App\Models;

use App\Contracts\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_from',
        'currency_to',
        'date',
    ];

    public static function boot(): void
    {
        parent::boot();

        ConversionRate::creating(function ($model) {
            $model->getConversionRate();
        });
    }

    public function getConversionRate(): void
    {
        $container = app();
        $currencyService = $container->make(CurrencyService::class);

        $conversionRate = $currencyService->getConversionRate(
            $this->currency_from,
            $this->currency_to,
        );

        if (is_null($conversionRate)) {
            $this->delete();

            throw new \RuntimeException('Incorrecte valuta');
        }

        $this->rate = $conversionRate;
    }
}
