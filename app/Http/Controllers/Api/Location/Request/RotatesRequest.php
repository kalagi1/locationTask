<?php

namespace App\Http\Controllers\Api\Location\Request;

use Illuminate\Foundation\Http\FormRequest;

class RotatesRequest extends FormRequest
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
            "latitude" => "required|numeric|between:-99.99,99.99",
            "longitude" => "required|numeric|between:-99.99,99.99"
        ];
    }
}
