<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|string',
            'city' => 'nullable|string',
            'county' => 'nullable|string',
            'keywords' => 'nullable|string',
            'primary_phone' => 'nullable|string',
            'fax' => 'nullable|string',
            'mobile_phone' => 'nullable|string',
            'company' => 'nullable|string',
            'country' => 'nullable|string',
            'contact_type' => 'nullable|string',

        ];
    }
}
