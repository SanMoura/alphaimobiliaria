<?php

namespace App\Http\Controllers\propostas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\cliente;
use App\Models\proposta;
use App\Models\status;
use App\Models\log_proposta;


class PropostaController extends Controller
{
    public function index(Request $request){

        $id_proposta = 0;
        $nm_cliente = 0;
        $status_cliente = 0;
        $cliente_id = 0;
        $nr_proposta = 0;
        $order = 'desc';
        $ultimo_status = null;

        $title = 'Proposta';
       

        $cliente = $request->only('cliente_id');

        $status = status::where('sn_ativo',true)->get();

        $propostas = proposta::where('sn_ativo', true)
        ->where('cliente_id', $cliente)
        ->get();

        foreach ($propostas as $proposta) {
            $nr_proposta = $proposta->id;
        }

        $log_propostas = log_proposta::with('status')
        ->where('proposta_id',$nr_proposta)
        ->orderBy('dt_atendimento', 'desc')
        ->orderBy('id','desc')
        ->paginate(8);

        $log_propostasH = log_proposta::with('status')
        ->where('proposta_id',$nr_proposta)
        ->get();

        foreach ($log_propostasH as $log_propostaH) {
            $ultimo_status = $log_propostaH->status->ds_status;
        }


        $proposta_clientes = proposta::where('sn_ativo', true)
        ->with('cliente')    
        ->with('users')
        ->with('status')
        ->where('cliente_id',$cliente)
        ->get();


        return view('propostas/cadastro', compact('title', 'proposta_clientes', 'propostas', 'status', 'log_propostas', 'ultimo_status'));
    }
    
    public function novaProposta(Request $request){

        $cliente_id = $request->input('cliente_id');

        $proposta_ativa = 0;

        $proposta = proposta::where('cliente_id',$cliente_id)
        ->where('sn_ativo',1)
        ->get();

        foreach($proposta as $propost){
            $proposta_ativa = $propost->id;
        }

        if ($proposta_ativa == 0){

            $proposta = proposta::create([
                'cliente_id' => $cliente_id,
                'user_id' => auth()->user()->id,
                
            ]);
    
            $log_proposta = log_proposta::create([
                'dt_atendimento' => now(),
                'status_id' => 1,
                'proposta_id' => $proposta->id,
            ]);
    
            return redirect()->route('proposta.index', ['cliente_id' => $request->only('cliente_id')]);
            

        }else{

            $response = [
                "success"   => false,
                "message"   => "O cliente já tem proposta ativa."
            ];

            return redirect()->route('historico')->with('error', $response['message']);
            
        }


    }

    public function finalizar(Request $request){

        
        $dados = proposta::find($request->input('proposta_id'));

        $dados->sn_ativo = false;
        
        $dados->save();
        
        return redirect()->route('home');

    }

    public function historico(Request $request){

        // $title = 'Histórico de Propostas Finalizadas';
        $title = 'PROPOSTAS FINALIZADAS';

        if (auth()->user()->cargo_id == 1){

            $proposta_clientes = proposta::where('sn_ativo', false)
            ->with('cliente')    
            ->with('users')
            ->with('status')
            ->paginate(10);

        }else{
            $proposta_clientes = proposta::where('sn_ativo', false)
            ->where('user_id', auth()->user()->id)
            ->with('cliente')    
            ->with('users')
            ->with('status')
            ->paginate(10);
        }

        

        //dd($proposta_clientes);


        return view('propostas/historico', compact('title', 'proposta_clientes'));
    }


}
