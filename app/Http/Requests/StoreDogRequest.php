<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDogRequest extends FormRequest
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
            'area' => 'required|string',
            'dog_type' => 'required|string',
            'color' => 'required|string',
            'temperament' => 'required|string',
            'gender' => 'required|string',
            'size' => 'required|string',
            'description' => 'required|string',
            'map_link' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg',
        ];
    }
}
