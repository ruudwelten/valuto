<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user() ? false : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'max:255',
                'unique:users',
                'email:rfc,dns',
            ],
            'password' => [
                'required',
                'min:6',
                'max:255',
            ],
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
            'name.required' => 'Uw naam is een verplicht veld',
            'name.string' => 'Dit is geen geldige naam',
            'name.max' => 'Uw naam mag uit maximaal 255 karakters bestaan',

            'email.required' => 'Uw e-mailadres is een verplicht veld',
            'email.max' => 'Uw e-mailadres mag uit maximaal 255 karakters bestaan',
            'email.unique' => 'Uw e-mailadres is al bij ons bekend, klik op \'Log in\' om in te loggen',
            'email.email' => 'Dit is geen geldig e-mailadres',

            'password.required' => 'Uw wachtwoord is een verplicht veld',
            'password.min' => 'Uw wachtwoord moet uit minimaal 6 karakters bestaan',
            'password.max' => 'Uw wachtwoord mag uit maximaal 255 karakters bestaan',
        ];
    }
}
