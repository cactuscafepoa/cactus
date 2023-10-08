<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaFormRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($request->id) /* edição */
        {
            return [
                'nome'         => 'bail|required|min:3|max:190',
                'descricao'    => 'bail|max:500',         /*'bail|min:6|max:500',*/
                'imagem'       => 'bail|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
            ];
        }
        else { /* inclusão */
            return [
                'nome'         => 'bail|required|min:3|max:190|unique:categorias',
                'descricao'    => 'bail|max:500',
                'imagem'       => 'bail|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
            ];
        }
    }

    public function messages()
    {
        return [
            'nome.required'            => 'Nome é obrigatório.',
            'nome.unique'              => 'Categoria já cadastrada com este nome.',
            /*'descricao.required'       => 'Descrição é obrigatória.',*/
            'imagem.image'             => 'Arquivo selecionado não é um tipo de imagem válida.',
            'imagem.mimes'             => 'Arquivo não é do tipo válido (jpg, jpeg, png, bmp, gif, svg ou webp).',
            'imagem.max'               => 'O tamanho da imagem não pode ser maior que 2MB.',
        ];
    }
}