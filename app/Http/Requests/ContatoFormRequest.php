<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoFormRequest extends FormRequest {

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
            'nome'    => 'required',
            'email'   => 'required|email',
            'mensagem' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required'    => 'Nome é obrigatório.',
            'email.required'   => 'E-mail é obrigatório.',
            'email.email'      => 'E-mail com formato inválido',
            'mensagem.required' => 'Mensagem é obrigatória.',
        ];
    }
}
