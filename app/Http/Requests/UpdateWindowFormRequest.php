<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWindowFormRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'unique:windows,name,' . $this->id,
                'min:3',
                'max:255'
            ],
            'description' => 'required|string|min:3',
            'user_id' => [
                'required',
                'integer',
                'unique:windows,user_id,' . $this->id,
            ],
            'services' => 'required|array',
            'services.*' => [
                'required',
                'integer',
            ],
            'is_active' => 'required|boolean',
            'has_doctor' => 'required|boolean',
        ];
    }
}
