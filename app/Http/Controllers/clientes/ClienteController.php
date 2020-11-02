<?php

namespace App\Http\Controllers\clientes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\ClienteUpdateRequest;


use App\Models\AcompCliente;
use App\Models\cliente;
use App\Models\Fonte;
use App\Models\proposta;
use App\Models\log_proposta;
use App\Models\PropostaUsers;
use App\User;


class ClienteController extends Controller
{

    public function index(){

        $title = 'Clientes';
        

        $usuarios = User::where('id', auth()->user()->id)->get();
        
        $cargo = $usuarios[0]->cargo_id;

        if (auth()->user()->cargo_id == 1){


            $clientes = cliente::orderBy('nome','asc')
            ->with(['proposta' => function ($r){
                $r->where('sn_ativo', true);
            }])
            ->with('fonte')
            ->paginate(9);

       

   
        }else{


            $clientes = cliente::orderBy('nome','asc')
            ->where('user_id', auth()->user()->id)
            ->with(['proposta' => function ($r){
                $r->where('sn_ativo', true);
            }])

            ->with('fonte')
            ->paginate(9);
        }


            $propostasAtivas = proposta::where('sn_ativo', true)
            ->get();

            

        return view('clientes/index', compact('title','clientes', 'cargo', 'propostasAtivas'));
    }

    
    public function cadCliente(){
        $title = 'Novo Cliente';

        $fontes = Fonte::where('sn_ativo', true)
            ->get();


        return view('clientes/cadastro', compact('title','fontes'));
    }

    public function editCliente( Request $request ){

        $title = 'Edição de Cliente';

        $fontes = Fonte::where('sn_ativo', true)
        ->get();

        $cliente_id = $request->only('cliente_id');

        $clientes = cliente::where('id',$cliente_id)->get();

        return view('clientes/edicao', compact('title','clientes','fontes'));
    }


    public function updateCliente( ClienteUpdateRequest $request ){

        $dados = cliente::find($request->input('cliente_id'));

        $dados->nome = $request->input('nome');
        $dados->cpf = $request->input('cpf');
        $dados->rg = $request->input('rg');
        $dados->telefone = $request->input('telefone');
        $dados->renda = $request->input('renda');
        $dados->fonte_id = $request->input('fonte');
        $dados->data = $request->input('data');
        
        $dados->save();
        
        return redirect()->route('cliente.index');
    }


    public function store(ClienteRequest $request){

        $validated = $request->validated();
        
        $cliente = cliente::create([
            'nome' => $request->input('nome'),
            'rg' => $request->input('rg'),
            'cpf' => $request->input('cpf'),
            'fonte_id' => $request->input('fonte'),
            'data' => $request->input('data'),
            'renda' => $request->input('renda'),
            'telefone' => $request->input('telefone'),
            'user_id' => auth()->user()->id,
        ]);

        // Solicitado para não criar proposta automatica na criação do cliente, ser criado um processo de acompanhamento do cliente
        // 11/10/2020
        /*
        $proposta = proposta::create([
            'cliente_id' => $cliente->id,
            //'user_id' => auth()->user()->id,
            
        ]);

        $propostaUsers = PropostaUsers::create([
            'proposta_id' => $proposta->id,
            'user_id' => auth()->user()->id,
            
        ]);

        $log_proposta = log_proposta::create([
            'dt_atendimento' => $request->input('data'),
            'status_id' => 1,
            'proposta_id' => $proposta->id,
            'observacoes' => $request->input('observacoes')
        ]);


        return redirect()->route('proposta.index', ['cliente_id' => $cliente->id]);
        */

        $acompCliente = acompCliente::create([
            'cliente_id' => $cliente->id,
            'status_id' => 1
            
        ]);

        return redirect()->route('acompCliente.index', ['cliente_id' => $cliente->id]);

    }

    
}
