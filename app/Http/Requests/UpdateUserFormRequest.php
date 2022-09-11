<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserFormRequest extends FormRequest
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'contact_no' => [
                'required',
                'numeric',
                'min:11',
                'unique:users,contact_no,' . $this->id,
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $this->id,
            ],
            'username' => [
                'required',
                'alpha_num',
                'min:4',
                'unique:users,username,' . $this->id
            ],
            'role' => 'required|string',
            'status' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
