<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorepropertyRequest extends FormRequest
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
            'type'=> 'in:a,h', 
            'address'=> 'required|string|max:95',
            'size'=> 'required|integer|min:10|max:2000',
            'price'=>'required|integer|min:1|max:10000',
            'number_of_bedrooms'=>'required|integer|min:1|max:20',
            'geolat'=>'numeric|between:-90.0000,90.0000',
            'geolng'=>'numeric|between:-180.0000,180.0000'
        ];
    }
}
