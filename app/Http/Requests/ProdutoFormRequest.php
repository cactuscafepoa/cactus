<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoFormRequest extends FormRequest
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
        {   //dd($request);

            if (!is_null($request->tpOper) && $request->tpOper == 'atualiza_preco') { // atualiza preço pela lista de produtos
                    $request->preco_venda = str_replace(".","",$request->preco_venda);
                    $request->preco_venda = str_replace(",",".",$request->preco_venda);
                    //dd($request->preco_venda);
                return [
                    'preco_venda'   => 'bail|required|not_in:0',
                ];
            }
            else {

                // VERIFICA SE HÁ NOME DE PRODUTO CADASTRADO PARA A CATEGORIA
                $produtoCategoria = DB::table('produtos')
                        ->where('id', '<>', $request->id)
                        ->where('categoria_id', '=', $request->categoria_id)
                        ->where('nome', '=', $request['nome'])
                        ->count();  //return $produtoCategoria;

                if ($produtoCategoria > 0)
                {
                    return [
                        'categoria_id'  => 'integer',
                        'nome'          => 'bail|required|min:3|max:190|unique:produtos,nome,NULL,id,categoria_id,'.$request->categoria_id,
                        'preco_venda'   => 'bail|required|min:0|not_in:0',
                        'fornecedor_id'	=> 'bail|required',
                        'descricao'     => 'bail|max:500',
                        'imagem'        => 'bail|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
                    ];
                }
                else {
                    return [
                        'categoria_id'  => 'integer',
                        'nome'          => 'bail|required|min:3|max:190',
                        'preco_venda'   => 'bail|required|min:0|not_in:0',
                        'fornecedor_id'	=> 'bail|required',
                        'descricao'     => 'bail|max:500',
                        'imagem'        => 'bail|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
                    ];
                }
            }
        }
        else { /* inclusão */
            return [
                'categoria_id'  => 'integer',
                'nome'          => 'bail|required|min:3|max:190|unique:produtos,nome,NULL,id,categoria_id,'.$request->categoria_id,
                'preco_venda'   => 'bail|required|min:0|not_in:0',
                'fornecedor_id'	=> 'bail|required',
                'descricao'     => 'bail|max:500',
                'imagem'        => 'bail|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
            ];
        }
    }

    public function messages()
    {
        return [
            'categoria_id.integer'    => 'Categoria é obrigatória.',
            'nome.required'           => 'Nome é obrigatório.',
            'nome.unique'             => 'Produto já cadastrado com este nome para esta categoria.',
            'preco_venda.required'    => 'Preço venda é obrigatório.',
            'preco_venda.min'         => 'Preço venda deve ser maior que zero.',
            'preco_venda.not_in'      => 'Preço venda deve ser maior que zero.',
            'fornecedor_id.required'  => 'Fornecedor é obrigatório.',
            /*'descricao.required'    => 'Descrição é obrigatória.',*/
            'imagem.image'            => 'Arquivo selecionado não é um tipo de imagem válida.',
            'imagem.mimes'            => 'Arquivo não é do tipo válido (jpg, jpeg, png, bmp, gif, svg ou webp).',
            'imagem.max'              => 'O tamanho da imagem não pode ser maior que 2MB.',
        ];
    }
}