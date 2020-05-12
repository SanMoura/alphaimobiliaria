<?php

namespace App\Http\Requests;

use App\User;

use Illuminate\Foundation\Http\FormRequest;


class UsuarioUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
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
            'password' => 'required|min:6',
            'cargo' => 'required',
            'email' => 'required|unique:users,email,'.$this->usuario_id,
            'cpf' => 'required|unique:users,cpf,'.$this->usuario_id,
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'password.required' => 'A Senha é Obrigatória.',
            'password.min' => 'A senha precisa ter no mínino 6 digitos.',
            'cargo.required' => 'O Cargo é obrigatório.',
            'email.required' => 'O Login é obrigatório.',
            'email.unique' => 'O Login já existe.',
            'cpf.required' => 'O CPF é Obrigatório.',
            'cpf.unique' => 'O CPF já existe.',
            
        ];
    }
}
