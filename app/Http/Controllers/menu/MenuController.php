<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Menu;
use App\Models\proposta;
use App\Models\log_proposta;

class MenuController extends Controller
{
    public function index(){

        $menus = Menu::where('sn_ativo',true)->where('tipo','N')->get();
        

        return $menus;
    }

    public function propostas(){
        
        $propostas = proposta::where('user_id',auth()->user()->id)
        ->get();

        $mes_atual = date('m',strtotime(now()->toDateTimeString()));
        $mes_anterior = date('m',strtotime(now()->toDateTimeString())) - 1;
        

        $propostas_mes = proposta::where('user_id',auth()->user()->id)
        ->whereRaw('date_format(created_at, \'%m\') = '.$mes_atual.' ')
        ->get();


        $propostas_mes_anterior = proposta::where('user_id',auth()->user()->id)
        ->whereRaw('date_format(created_at, \'%m\') = '.$mes_anterior .' ')
        ->get();

        
        
        $cont_mes = 'Mês Anterior: '.count($propostas_mes_anterior).' / Mês Atual: '. count($propostas_mes);
        

        $dados = [
            $propostas, $cont_mes
        ];
        


        return $dados;
    }

    public function visitas(){

        return static::logProposta(3);
    }


    public function assinaturas(){

        return static::logProposta(4);
    }


    public function entrega_chaves(){

        return static::logProposta(5);
    }


    public function logProposta($status){

        $logProposta = log_proposta::where('status_id',$status)
        ->with('proposta')
        ->whereHas('proposta', function ($query){
            $query->where('user_id',auth()->user()->id);
        })->get();


        $mes_atual = date('m',strtotime(now()->toDateTimeString()));

        $mes_anterior = date('m',strtotime(now()->toDateTimeString())) - 1;

        $propostas_mes = log_proposta::with(['proposta' => function ($q){
            $q->where('user_id','user_id',auth()->user()->id);
        }])
        ->whereRaw('date_format(dt_atendimento, \'%m\') = '.$mes_atual.' ')
        ->where('status_id',$status)
        ->get();

        $propostas_anterior = log_proposta::with(['proposta' => function ($q){
            $q->where('user_id','user_id',auth()->user()->id);
        }])
        ->whereRaw('date_format(dt_atendimento, \'%m\') = '.$mes_anterior.' ')
        ->where('status_id',$status)
        ->get();

        $cont_mes = 'Mês Anterior: '.count($propostas_anterior).' / Mês Atual: '. count($propostas_mes);

        return $dados = [
                $logProposta, $cont_mes
            ];
    }
}
