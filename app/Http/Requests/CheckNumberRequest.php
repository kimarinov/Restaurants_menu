<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckNumberRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

  
   public function rules()
    {
        return [
            'money' => 'required|numeric|min:0|not_in:0',
            'number_of_people' => 'required|numeric|min:0|not_in:0',
        ];
    }
    public function messages()
    {
        return [
            'money.required' => 'Полето е задължително!',
            'money.numeric'     => 'Полето трябва да е цифра!',
            'money.min'     => 'Полето трябва да е положително!',
            'money.not_in'     => 'Полето трябва да не е 0!',
            'number_of_people.required' => 'Полето е задължително!',
            'number_of_people.numeric'     => 'Полето трябва да е цифра!',
            'number_of_people.min'     => 'Полето трябва да е положително!',
            'number_of_people.not_in'     => 'Полето трябва да не е 0!',
        ];
    }
}
