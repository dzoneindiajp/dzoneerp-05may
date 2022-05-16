<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowroomRequest extends FormRequest
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
            'name' => [
                'required',
            ],
            'code' => [
                'required',
                'unique:showrooms,code,'.$this->id,
            ],
            'manager_name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                'unique:showrooms,email,'.$this->id,
            ],
            'phone' => [
                'required',
                'numeric',
            ],
            'address' => [
                'required',
                'string',
            ],
            'note' => [
                'required',
                'string',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
