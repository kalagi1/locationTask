<?php

namespace App\Http\Controllers\Api\Location\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLocationRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('locations')->ignore($this->location),
            ],
            "latitude" => "required|numeric|between:-99.99,99.99",
            "longitude" => "required|numeric|between:-99.99,99.99",
            "marker_color_hex" => "required|string",
        ];
    }
}
