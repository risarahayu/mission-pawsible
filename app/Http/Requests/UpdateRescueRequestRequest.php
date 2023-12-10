<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRescueRequestRequest extends FormRequest
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
            'rescuer_id' => 'nullable',
            'area' => 'required',
            'dog_type' => 'required|string',
            'color' => 'required|string',
            'temperament' => 'required|string',
            'gender' => 'required|string',
            'size' => 'required|string',
            'description' => 'required|string',
            'map_link' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'delete_image' => 'boolean',
        ];
    }
}
