<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'catid' => [
                    'required',
                ],
                'subcatid' => [
                    'required',
                ],
                'name' => [
                    'required',
                    'string',
                ],
                'unitid' => [
                    'required',
                    'string',
                ],
                'isfinishedproduct' => [
                    'required',
                ],
            ];
        } else {
            return [
                'catid' => [
                    'required',
                ],
                'subcatid' => [
                    'required',
                ],
                'name' => [
                    'required',
                    'string',
                ],
                'unitid' => [
                    'required',
                    'string',
                ],
                'image' => [
                    'required',
                ],
                'isfinishedproduct' => [
                    'required',
                ],
            ];
        }
    }
    public function messages()
    {
        return [
            'catid.required' => 'Category Is Required',
            'subcatid.required' => 'SubCategory Is Required',
            'unitid.required' => 'Unit Is Required',
            'isfinishedproduct.required' => 'Select any One',
        ];
    }
}
