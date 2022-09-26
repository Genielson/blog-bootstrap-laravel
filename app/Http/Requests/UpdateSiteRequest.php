<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteRequest extends FormRequest
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


    public function rules()
    {
        return [
            'title'=>'required|min:1|max:100',
            'header'=>'required',
            'footer'=>'required',
            'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => ' O titulo não pode estar em branco',
            'title.min' => 'O titulo deve ter ao menos 1 caractere' ,
            'title.max' => 'O titulo deve ter no máximo 100 caracteres',
            'image.required' => ' É obrigatório inserir uma imagem ',
            'image.image' => 'O upload tem que ser do tipo imagem',
            'image.mimes' => ' O formato de envio deve ser pg,png,jpeg,gif,svg ',
            'image.max' => ' O tamanho máximo para upload de imagem é 2MB',
            'header.required' => ' É necessario escolher uma cor para o header ',
            'footer.required' => ' É necessario escolher uma cor para o footer '
        ];
    }

}
