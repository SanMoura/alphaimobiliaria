<?php

namespace App\Http\Requests;

use App\Models\cliente;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
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
            'cpf' => 'required|unique:cliente,cpf,'.$this->cliente_id,
            'rg' => 'required',
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
            'cpf.unique' => 'CPF já existente',
            'rg.required' => 'RG é obrigatório',
            'telefone.required' => 'TELEFONE é obrigatório',
            'renda.required' => 'RENDA é obrigatório',
            'fonte.required' => 'FONTE é obrigatório',
            'data.required' => 'DATA é obrigatória',
            'nome.required' => 'NOME é obrigatório',
            
        ];
    }
}
