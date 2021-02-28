<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'currency_from',
        'currency_to',
        'amount_from',
        'amount_to',
        'date',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];
}
