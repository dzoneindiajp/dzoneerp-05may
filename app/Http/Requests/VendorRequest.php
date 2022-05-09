<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
        if ($this->isMethod('put')) {
            return [
                'name' => [
                    'string',
                    'required',
                ],
                'email' => [
                    'required',
                    'unique:users,id,'.$this->user_id,
                ],
                'company' => [
                    'required',
                    'string',
                ],
                'destignation' => [
                    'required',
                    'string',
                ],
                'address' => [
                    'required',
                    'string',
                ],
                'status' => [
                    'required',
                ],

            ];
        } else {

            return [
                'name' => [
                    'string',
                    'required',
                ],
                'email' => [
                    'required',
                    'unique:users',
                ],
                'company' => [
                    'required',
                    'string',
                ],
                'destignation' => [
                    'required',
                    'string',
                ],
                'address' => [
                    'required',
                    'string',
                ],
                'status' => [
                    'required',
                ],

            ];
        }
    }
}
