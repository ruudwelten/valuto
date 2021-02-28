<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ConvertRequest;
use App\Models\Conversion;
use App\Models\ConversionRate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ConversionController extends Controller
{
    public function convert(ConvertRequest $request): JsonResponse
    {
        $input = $request->validated();

        $conversionRate = ConversionRate::select('rate')
            ->where('currency_from', $input['currencyFrom'])
            ->where('currency_to', $input['currencyTo'])
            ->where('date', Carbon::today())
            ->first()
            ?? ConversionRate::create([
                'currency_from' => $input['currencyFrom'],
                'currency_to' => $input['currencyTo'],
                'date' => Carbon::today(),
            ]);

        $conversion = Conversion::create([
            'user_id' => $request->user()->id,
            'currency_from' => $input['currencyFrom'],
            'currency_to' => $input['currencyTo'],
            'amount_from' => $input['amount'],
            'amount_to' => $input['amount'] * $conversionRate->rate,
            'date' => Carbon::today(),
        ]);

        return response()->json($conversion);
    }

    public function history(Request $request, int $limit): JsonResponse
    {
        $conversions = Conversion::where('user_id', $request->user()->id)
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();

        return response()->json($conversions);
    }
}
