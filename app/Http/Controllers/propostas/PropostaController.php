<?php

namespace App\Http\Controllers\propostas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\cliente;
use App\Models\proposta;
use App\Models\status;
use App\Models\log_proposta;
use App\Models\PropostaUsers;
use App\User;
use App\Models\Cargos;


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
        $imovel = '';
        $valorImovel = '';
        $userAddNome = '';
        $usuario_add = 0;

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
            $imovel = $log_propostaH->imovel;
            $valorImovel = $log_propostaH->valorImovel;
        }

        $dados = PropostaUsers::where('proposta_id', $nr_proposta)->get();
        foreach ($dados as $dado) {
            $usuario_add = $dado->user_id_adicional;
        }

        $userAddNomeFs = User::where('id', $usuario_add)->get();
        foreach ($userAddNomeFs as $userAddNomeF) {
            $userAddNome = $userAddNomeF->name;
        }
        
        $usuarios = User::where('id', '<>', auth()->user()->id)
        ->where('cargo_id' ,'<>', 1)
        ->where('id' ,'<>', $usuario_add)
        ->get();


        $proposta_clientes = proposta::where('sn_ativo', true)
        ->with('cliente')    
        //->with('proposta_users_relation')
        ->with('status')
        ->where('cliente_id',$cliente)
        ->get();


        return view('propostas/cadastro', compact('title', 'proposta_clientes', 'propostas', 'status', 'log_propostas', 'ultimo_status', 'imovel', 'valorImovel', 'usuarios', 'usuario_add','userAddNome'));
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
                //'user_id' => auth()->user()->id,
                
            ]);

            $propostaUsers = PropostaUsers::create([
                'proposta_id' => $proposta->id,
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

        $imovel = null;
        $valorImovel = null;

        $verifDadosPropostas = log_proposta::where('proposta_id', $request->input('proposta_id'))
        ->get();

        

        foreach ($verifDadosPropostas as $verifDadosProposta) {

            $imovel = $verifDadosProposta->imovel;
            $valor = $verifDadosProposta->valorImovel;

        }

        

        if ($imovel != null && $valor != null){

            $dados = proposta::find($request->input('proposta_id'));

            $dados->sn_ativo = false;
        
            $dados->save();

            $response = [
                "success"   => true,
                "message"   => "Proposta finalizada com sucesso!."
            ];

            return redirect()->route('home')->with('success', $response['message']);

        }else{

            $response = [
                "success"   => false,
                "message"   => "O Imóvel ou o valor não foram cadastrados, favor rever."
            ];

            return redirect()->route('proposta.index', ['cliente_id' => $request->input('cliente_id')])->with('error', $response['message']);

        }

    }

    public function historico(Request $request){

        // $title = 'Histórico de Propostas Finalizadas';
        $title = 'PROPOSTAS FINALIZADAS';

        if (auth()->user()->cargo_id == 1){

            $proposta_clientes = proposta::where('sn_ativo', false)
            ->with('cliente')
            ->with('status')
            ->paginate(10);

        }else{
            $proposta_clientes = proposta::where('sn_ativo', false)
            ->join('proposta_users', 'proposta.id', '=', 'proposta_users.proposta_id')
            ->where('proposta_users.user_id', auth()->user()->id)
            ->with('cliente')    
            //->with('users')
            ->with('status')
            ->paginate(10);
        }

        

        //dd($proposta_clientes);


        return view('propostas/historico', compact('title', 'proposta_clientes'));
    }

    public function gerenciaPontos(){

        $title = 'Gerenciamento de Pontos';

        $pontos = proposta::where('sn_ativo', false)
                              ->where('gerencPontos', false)
                              ->with([

                              ])
                              ->with('proposta_users_relation')
                              ->get();

        // dd($pontos);

        return view('planoCarreira.index', compact('title', 'pontos'));

    }


    public function atribuiPontos(Request $request){

        

        $vNrProposta        = $request->input('vNrProposta');

        $user_id            = $request->input('user_id');
        
        $user_id_adicional  = $request->input('user_id_adicional');

        $valor1             = $request->input('valor1');

        $valor2             = $request->input('valor2');

        // faz o processo com o primeiro usuario
        $user1 = User::where('id', $user_id)->with('cargo')->get();

        foreach ($user1 as $user1v) {
            $pontos1 = $user1v->pontos;
            $cargo1 = $user1v->cargo_id;
            $pCargo1 = $user1v->cargo->pontos;
        }


        if ($pontos1 == null){

            $pNcargo = $pCargo1 + ($valor1);

            $cargos = Cargos::where('id', '<>', 1)->orderBy('id','desc')->get();

            foreach ($cargos as $cargo) {
                
                if ($pNcargo >= $cargo->pontos){

                    $updCargo = User::find($user_id);

                    $updCargo->cargo_id = $cargo->id;
                    $updCargo->pontos   = $pNcargo;
                    
                    $updCargo->save();

                    break;

                    
                }

            }

        }else{

            $pNcargo = $pontos1 + ($valor1);

            $cargos = Cargos::where('id', '<>', 1)->orderBy('id','desc')->get();

            foreach ($cargos as $cargo) {
                
                if ($pNcargo >= $cargo->pontos){

                    $updCargo = User::find($user_id);

                    $updCargo->cargo_id = $cargo->id;
                    $updCargo->pontos   = $pNcargo;
                    
                    $updCargo->save();

                    break;

                    
                }

            }

        }


        // verifica se existe user adicional
        if ($user_id_adicional != null){

            $user2 = User::where('id', $user_id_adicional)->with('cargo')->get();

            foreach ($user2 as $user2v) {
                $pontos2 = $user2v->pontos;
                $cargo2 = $user2v->cargo_id;
                $pCargo2 = $user2v->cargo->pontos;
            }

            
    
    
            if ($pontos2 == null){
    
                $pNcargo2 = $pCargo2 + ($valor2);

                $cargos2 = Cargos::where('id', '<>', 1)->orderBy('id','desc')->get();

                foreach ($cargos2 as $cargo2) {
                    
                    if ($pNcargo2 >= $cargo2->pontos){
    
                        $updCargo2 = User::find($user_id_adicional);
    
                        $updCargo2->cargo_id = $cargo2->id;
                        $updCargo2->pontos  = $pNcargo2;
                        
                        $updCargo2->save();
    
                        break;
    
                        
                    }
    
                }
    
            }else{
    
                $pNcargo2 = $pontos2 + ($valor2);

                $cargos2 = Cargos::where('id', '<>', 1)->orderBy('id','desc')->get();

                foreach ($cargos2 as $cargo2) {
                    
                    if ($pNcargo2 >= $cargo2->pontos){
    
                        $updCargo2 = User::find($user_id_adicional);
    
                        $updCargo2->cargo_id = $cargo2->id;
                        $updCargo2->pontos  = $pNcargo2;
                        
                        $updCargo2->save();
    
                        break;
    
                        
                    }
    
                }
    
            }
     
        }

        


        //final do processo update na proposta

        $dados = proposta::find($vNrProposta);

        $dados->gerencPontos = true;
        
        $dados->save();


        return 'Pontos Atribuidos';

    }


}
