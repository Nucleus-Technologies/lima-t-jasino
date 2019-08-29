<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutfitRequest extends FormRequest
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
            'name' => 'required|string|unique:outfits',
            'price' => 'required|integer',
            'category' => 'required|string',
            'type' => 'required|integer',
            'availibility' => 'required|string',
            'context' => 'required|string',
            'description' => 'required|string',
            'specification' => 'required|string',
            'photos' => 'required|array',
            'photos.*' => 'required|image|mimes:jpg,jpeg,bmp,png'
        ];
    }
}
