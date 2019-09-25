<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addNewCase extends FormRequest
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
            'ccn' => 'nullable|unique:cases,ccn|max:255',
            'docketnumber' => 'required|unique:cases,docketnumber|max:255',
            'acmo' => 'nullable|unique:cases,acmo|max:255',
        ];
    }
    public function messages()
        {
            return [
                'docketnumber.required'  => 'CAR case number attribute is required',
            ];
        }
}
