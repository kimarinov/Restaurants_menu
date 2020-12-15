<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateDishesRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric|min:0|not_in:0',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Полето е задължително!',
            'name.min' => 'минимум 3 знака!',
            'price.required'     => 'Полето е задължително!',
            'price.numeric'     => 'Полето трябва да е цифра!',
            'price.min'     => 'Полето трябва да е положително!',
            'price.not_in'     => 'Полето трябва да не е 0!',
        ];
    }
}
