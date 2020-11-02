<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AcompCliente;
use App\Models\cliente;
use App\Models\status;
use App\Models\proposta;
use App\Models\log_proposta;
use App\Models\PropostaUsers;

class acompController extends Controller
{
    public function index(Request $request){
        $title = 'Acompanhamento de Clientes';

        $cliente_id = $request->input('cliente_id');

        $dadosCliente = cliente::find($cliente_id);

        $status = status::where('sn_ativo',true)
        ->where('tp_status', 'C')
        ->get();
        
        $acomps = AcompCliente::where('cliente_id', $cliente_id)
            ->with('cliente')
            ->with('status')
            ->orderby('created_at','desc')
            ->paginate(5);

        return view('clientes.acompanhamento', compact('title', 'acomps', 'dadosCliente', 'status'));
    }


    public function store(Request $request){
        $idStatusProposta = 5;
        
        
        
        $acompCliente = acompCliente::create([
            'cliente_id' => $request->input('cliente_id'),
            'status_id' => $request->input('status_id'),
            'observacoes' => $request->input('observacoes'),
        ]);

        
        if($request->input('status_id') == $idStatusProposta){
            $proposta = proposta::create([
                'cliente_id' => $request->input('cliente_id'),
                //'user_id' => auth()->user()->id,
                
            ]);
    
            $propostaUsers = PropostaUsers::create([
                'proposta_id' => $proposta->id,
                'user_id' => auth()->user()->id,
                
            ]);
    
            $log_proposta = log_proposta::create([
                'dt_atendimento' => now(),
                'status_id' => $idStatusProposta,
                'proposta_id' => $proposta->id,
                'observacoes' => $request->input('observacoes')
            ]);

            return redirect()->route('proposta.index', ['cliente_id' => $request->input('cliente_id')]);

        }

        return redirect()->route('acompCliente.index', ['cliente_id' => $request->input('cliente_id')]);
    }
}
