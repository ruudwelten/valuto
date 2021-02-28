<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return ($this->user()->id == $this->input()['id']);
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
                Rule::unique('users')->ignore($this->input()['id']),
                'email:rfc,dns',
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
            'email.unique' => 'Dit e-mailadres is gekoppeld aan een ander account',
            'email.email' => 'Dit is geen geldig e-mailadres',
        ];
    }
}
