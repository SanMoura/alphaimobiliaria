<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class novaPropostaRequest extends FormRequest
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
            'sn_ativo' => 0,
        ];
    }


    public function messages()
    {
        return [
            'sn_ativo' => 'O cliente já tem propostas ativas.',
            
            
        ];
    }
}
