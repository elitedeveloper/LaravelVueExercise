<?php

namespace App\Http\Requests\Street;

use Illuminate\Foundation\Http\FormRequest;

class StoreStreet extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "postal_code" => "required|exists:postal_codes,id",
            "route" => "required"
        ];
    }

    public function messages()
    {
        return [
            "postal_code.required" => "Postal Code is Required",
            "postal_code.exists" => "Postal Code doesn't Exists!"
        ];
    }
}
