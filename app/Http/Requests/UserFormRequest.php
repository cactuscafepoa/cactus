<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserFormRequest extends FormRequest {

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
                'name'    => 'bail|required|min:3|max:190',
                'email'    => 'bail|required|min:3|max:190',
            ];
        }
        else {
            return [
                'name'    => 'bail|required|min:3|max:190',
                'email'    => 'bail|required|min:3|max:190',
                'password' => 'bail|required|min:8|max:190',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required'    => 'Nome é obrigatório.',
            'email.required'    => 'E-mail é obrigatório.',
            'password.required'    => 'Informe uma senha provisória.',
        ];
    }
}
