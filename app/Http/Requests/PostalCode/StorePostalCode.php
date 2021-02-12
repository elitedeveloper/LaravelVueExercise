<?php

namespace App\Http\Requests\PostalCode;

use Illuminate\Foundation\Http\FormRequest;

class StorePostalCode extends FormRequest
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
            "id" => "required|unique:postal_codes,id",
            "country"   => "required|string",
            "locality"  => "required|string"
        ];
    }

    public function messages()
    {
        return [
            "id.required" => "Postal Code is Required",
            "id.unique" => "Postal Code Exists!"
        ];
    }
}
