<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'nome' => 'required',
            'cpf' => 'required|unique:cliente',
            'rg' => 'required|unique:cliente',
            'telefone' => 'required',
            'renda' => 'required',
            'fonte' => 'required',
            'data' => 'required',
            
        ];
    }


    public function messages()
    {
        return [
            'cpf.required' => 'CPF é obrigatório',
            'cpf.unique' => 'CPF digitado já existente',
            'rg.required' => 'RG é obrigatório',
            'rg.unique' => 'RG digitado já existente',
            'telefone.required' => 'TELEFONE é obrigatório',
            'renda.required' => 'RENDA é obrigatório',
            'fonte.required' => 'FONTE é obrigatório',
            'data.required' => 'DATA é obrigatória',
            'nome.required' => 'NOME é obrigatório',
            
        ];
    }
}
