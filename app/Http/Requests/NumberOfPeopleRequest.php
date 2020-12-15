<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NumberOfPeopleRequest extends FormRequest
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

  
    public function rules()
    {
        return [
             'first_order_people' => 'required|numeric|min:0|not_in:0',
        ];
    }
    public function messages()
    {
        return [
            'first_order_people.required' => 'Полето е задължително!',
            'first_order_people.numeric'     => 'Полето трябва да е цифра!',
            'first_order_people.min'     => 'Полето трябва да е положително!',
            'first_order_people.not_in'     => 'Полето трябва да не е 0!',
        ];
    }
}
