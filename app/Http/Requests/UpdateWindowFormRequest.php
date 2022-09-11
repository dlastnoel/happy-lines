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
                'unique:windows,name,' . $this->id,
                'string',
                'min:3',
                'max:255'
            ],
            'transaction_id' => [
                'required',
                'integer',
                'unique:windows,service_id,' . $this->id,
            ],
            'description' => 'required|string|min:3',
            'is_occupied' => 'sometimes|nullable|boolean',
            'is_active' => 'sometimes|nullable|boolean',
        ];
    }
}
