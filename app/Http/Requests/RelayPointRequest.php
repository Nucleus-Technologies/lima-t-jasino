<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelayPointRequest extends FormRequest
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
            'region' => 'required|integer',
            'city' => 'required|integer',
            'label' => 'required|string',
            'near' => 'required|string',
            'address' => 'required|string',
            'contact' => 'required|string',
            'opening_hours' => 'required|string',
            'shipping_cost' => 'required|integer'
        ];
    }
}
