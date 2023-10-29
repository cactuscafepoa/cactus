<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfiguracaoFormRequest extends FormRequest
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
                'cardapio_fisico_qtd' => 'bail|required|numeric|min:20|max:100',
            ];
        }
    }

    public function messages()
    {
        return [
            'cardapio_fisico_qtd.required' => 'Quantidade de produtos por coluna é obrigatório.',
            'cardapio_fisico_qtd.min' => 'O valor mínimo para a quantidade de produtos por coluna é 20.',
            'cardapio_fisico_qtd.max' => 'O valor máximo para a quantidade de produtos por coluna é 100.',
        ];
    }
}