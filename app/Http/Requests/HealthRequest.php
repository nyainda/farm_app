<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HealthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vaccination_status' => 'nullable|string',
            //'vet_contact_id' => 'nullable|integer',
            'medical_history' => 'nullable|string',
            'dietary_restrictions' => 'nullable|string',
            //'neutered_spayed' => 'nullable|boolean',
            'regular_medication' => 'nullable|string',
            'last_vet_visit' => 'nullable|date',
            'insurance_details' => 'nullable|string',
            'exercise_requirements' => 'nullable|string',
            'parasite_prevention' => 'nullable|string',
        ];
    }
}
