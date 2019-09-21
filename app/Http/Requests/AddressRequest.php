<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' => 'required|email',
            'zone' => [
                'required',
                Rule::in(['national', 'international'])
            ],
            'country' => 'required|string',
            'phone1' => 'required|string',
            'phone2' => 'nullable|string',
            'addressline1' => 'required|string',
            'addressline2' => 'nullable|string',
            'region' => 'required|integer',
            'city' => 'required|integer',
            'zip' => 'nullable|integer'
        ];
    }
}
