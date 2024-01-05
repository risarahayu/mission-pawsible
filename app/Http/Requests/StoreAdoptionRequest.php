<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdoptionRequest extends FormRequest
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
        'user_id' => 'required',
        'dog_id' => 'required',
        'housing_type' => 'required|string',
        'housing_permission' => 'required|boolean',
        'housing_condition' => 'required|boolean',
        'pet_experience' => 'nullable|string',
        'residency_duration' => 'nullable|string',
        'planned_residency_duration' => 'nullable|string',
        'future_residency_country' => 'nullable|string',
        'pet_migration_plan' => 'nullable|boolean',
        'job' => 'required|string',
        'house_occupants' => 'nullable|string',
        'canine_residence' => 'nullable|string',
        'vaccinated' => 'required|boolean',
    ];
}

}
