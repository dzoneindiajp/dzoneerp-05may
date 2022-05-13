<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DamagePurchaseRequest extends FormRequest
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
            'reason' => [
                'required',
            ],
            'date' => [
                'required',
            ],
            'purchase' => [
                'required',
            ],
            'damageqty' => [
                'required',
            ],
            'note' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
