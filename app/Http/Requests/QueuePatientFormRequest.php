<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QueuePatientFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'patient' => [
                'unique_id' => 'sometimes',
                'fullname' => 'required',
                'sex' => 'required',
                'birthdate' => 'required',
                'address' => 'required',
                'contact_no' => 'required',
            ],
            'window_id' => 'required|numeric'
        ];
    }
}
