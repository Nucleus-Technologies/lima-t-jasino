<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentFormRequest extends FormRequest
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
        $today = date('Y-m-d');

        return [
            'location' => 'required|string',
            'takes_place_the' => 'required|date_format:Y-m-d|after_or_equal:' .$today,
            'starts_at' => 'required|date_format:H:i',
            'ends_at' => 'required|date_format:H:i|after:starts_at',
            'specified_message' => 'nullable|string'
        ];
    }
}
