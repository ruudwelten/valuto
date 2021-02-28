<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;  // Authorization is checked by Sanctum
    }

    /**
     * Prepare data for validation.
     *
     * @return void
     **/
    protected function prepareForValidation(): void
    {
        if (
            !isset($this->amount) ||
            !isset($this->currencyFrom) ||
            !isset($this->currencyTo)
        ) {
            return;
        }

        $amount = trim($this->amount);

        if (preg_match('/^[0-9]*(\.[0-9]*)?$/', $amount)) {
            $amount = (float) $amount;
        } elseif (preg_match('/^[0-9]*,[0-9]*$/', $amount)) {
            $amount = str_replace(',', '.', $amount);
        } elseif (preg_match('/^[0-9\.]*(,[0-9]*)?$/', $amount)) {
            $amount = str_replace(['.', ','], ['', '.'], $amount);
        } elseif (preg_match('/^[0-9,]*(\.[0-9]*)?$/', $amount)) {
            $amount = str_replace(',', '', $amount);
        }

        $this->merge([
            'amount' => (float) $amount,
            'currencyFrom' => strtoupper($this->currencyFrom),
            'currencyTo' => strtoupper($this->currencyTo),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'amount' => 'required',
            'currencyFrom' => 'required',
            'currencyTo' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     **/
    public function messages(): array
    {
        return [
            'amount.required' => 'Bedrag is een verplicht veld',
            'currencyFrom.required' => 'Van valuta is een verplicht veld',
            'currencyTo.required' => 'Naar valuta is een verplicht veld',
        ];
    }
}
