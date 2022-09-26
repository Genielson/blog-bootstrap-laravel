<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category' => 'required|min:1|max:20'
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'O campo Nome deve ser preenchido',
            'category.min' => 'O titulo deve ter ao menos 1 caractere',
            'categoty.max' => 'O titulo deve ter no máximo 20 caracteres'
        ];
    }

}
