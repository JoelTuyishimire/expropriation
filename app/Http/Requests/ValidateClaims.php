<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateClaims extends FormRequest
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
            'title' => 'required',
            'expropriation_id'=> 'required',
            'description' => 'required',
//            'citizen_id' =>'required'
        ];
    }

    public function messages()
    {
        return [
            'expropriation_id.required'=> 'The expropriation Property field is required.',
        ];
    }
}
