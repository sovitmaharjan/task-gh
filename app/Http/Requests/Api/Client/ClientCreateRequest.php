<?php

namespace App\Http\Requests\Api\Client;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientCreateRequest extends FormRequest
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
            "name" => "required|string",
            "gender" => ["required", Rule::in(MALE, FEMALE, OTHER)],
            "phone" => "required|string",
            "email" => "required|email",
            "address" => "required|string",
            "nationality" => "required|string",
            "dob" => "required|date",
            "education_background" => "required|array",
            "education_background.*.level" => "required|string",
            "education_background.*.graduated_year" => "required|string",
            "contact_mode" => ["nullable", Rule::in(EMAIL, PHONE)],
        ];
    }
}
