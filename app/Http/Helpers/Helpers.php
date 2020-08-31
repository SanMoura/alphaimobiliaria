<?php
namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Models\log_proposta;

class Helpers
{
    public static function identificaUsuario($codUsuario)
    {
        $nome = '';
        if ($codUsuario > 0){

            $retUsuarios = User::where('id', $codUsuario)
                                ->get();

            foreach ($retUsuarios as $retUsuario) {
                $nome = $retUsuario->name;
            }                              
        }


        return $nome;
    }


    public static function imovelDescValor($id_proposta)
    {
        $imovels = log_proposta::where('proposta_id', $id_proposta)
                              ->get();

        foreach ($imovels as $imovel) {
            $valorImovel = $imovel->valorImovel;
            $descricaoImovel = $imovel->imovel;
        }                              


        return $imovelReturn = [
            'valor' => $valorImovel, 
            'descricao' => $descricaoImovel
        ];
    }

    public static function totalStatus($status, $user_id, $dt_ini, $dt_fim){
        
    $dados = DB::select('
        SELECT
            count(log_proposta.status_id) TOTAL_POR_STATUS
            
        FROM
            cliente, 
            proposta, 
            log_proposta
        where 
            cliente.id = proposta.cliente_id
            and proposta.id = log_proposta.proposta_id
            and log_proposta.status_id = '.$status.'
            and cliente.user_id = '.$user_id.'
            and log_proposta.dt_atendimento between "'.$dt_ini.'" and "'.$dt_fim.'"
    ');

    $res = 0;

    foreach ($dados as $dado) {
        $res = $dado->TOTAL_POR_STATUS;
    }

    return $res;

    }


    public static function totalClientesCorretor($user_id, $dt_ini, $dt_fim){
        
        $dados = DB::select('
            SELECT
                count(cliente.id) TOTAL
                
            FROM
                cliente
            where
                cliente.user_id = '.$user_id.'
                and cliente.data between "'.$dt_ini.'" and "'.$dt_fim.'"
        ');

        
    
        $res = 0;
    
        foreach ($dados as $dado) {
            $res = $dado->TOTAL;
        }
    
        return $res;
    
    }


    public static function totalClientesGeral($dt_ini, $dt_fim, $tp_mes){
        if ($tp_mes == 0){

            $dados = DB::select('
            SELECT
                count(cliente.id) TOTAL
                
            FROM
                cliente
            WHERE
                cliente.data between date_sub("'.$dt_ini.'", INTERVAL 1 month) and date_sub("'.$dt_fim.'", INTERVAL 1 month)
                
            '); 

        }elseif($tp_mes == 1 ){

            $dados = DB::select('
            SELECT
                count(cliente.id) TOTAL
                
            FROM
                cliente
            WHERE
                cliente.data between "'.$dt_ini.'" and "'.$dt_fim.'"                
                
            ');
        }
        
    
        $res = 0;
    
        foreach ($dados as $dado) {
            $res = $dado->TOTAL;
        }
    
        return $res;
    
    }    


    public static function fontes($user_id, $dt_ini, $dt_fim){

        $dados = null;

        $dados = DB::select('
        select 
            count(fonte_id) total, 
            ds_fonte
        from 
            cliente, 
            fonte
        where 
            fonte.id = cliente.fonte_id
            and cliente.user_id = '.$user_id.'
            and cliente.data between "'.$dt_ini.'" and "'.$dt_fim.'"

        GROUP BY 
            cliente.user_id,
            cliente.fonte_id
        order by 
            count(fonte_id) desc
        limit 3
        ');
    
        return $dados;
    
    }


    public static function fontesGeral($dt_ini, $dt_fim, $tp_mes){

        $dados = null;

        if ($tp_mes == 0){
            $dados = DB::select('
            select 
                count(fonte_id) total, 
                ds_fonte
            from 
                cliente, 
                fonte
            where 
                fonte.id = cliente.fonte_id
                and cliente.data between date_sub("'.$dt_ini.'", INTERVAL 1 month) and date_sub("'.$dt_fim.'", INTERVAL 1 month)
            GROUP BY 
                fonte.ds_fonte
            order by 
                count(fonte_id) desc
            limit 4
            ');
        }elseif($tp_mes == 1){
            $dados = DB::select('
            select 
                count(fonte_id) total, 
                ds_fonte
            from 
                cliente, 
                fonte
            where 
                fonte.id = cliente.fonte_id
                and cliente.data between "'.$dt_ini.'" and "'.$dt_fim.'"
            GROUP BY 
                fonte.ds_fonte
            order by 
                count(fonte_id) desc
            limit 4
            ');
        }

        
    
        return $dados;
    
    }    

    public static function totalPropostas($user_id, $dt_ini, $dt_fim){

        $dados = null;

        $dados = DB::select('
        select 
            count(proposta.id) total
        from 
            cliente, 
            proposta
        where 
            cliente.id = proposta.cliente_id
            and cliente.user_id = '.$user_id.'
            and str_to_date(proposta.created_at, "%Y-%m-%d") between "'.$dt_ini.'" and "'.$dt_fim.'"
        ');
    
        $res = 0;
    
        foreach ($dados as $dado) {
            $res = $dado->total;
        }
    
        return $res;
    
    }


    public static function totalVendas($user_id, $dt_ini, $dt_fim){

        $dados = null;

        $dados = DB::select('
        select 
            count(proposta.id) total
        from 
            cliente, 
            proposta
        where 
            cliente.id = proposta.cliente_id
            and cliente.user_id = '.$user_id.'
            and proposta.sn_ativo = 0
            and proposta.motivo_finalizacao_id = 1
            and str_to_date(proposta.created_at, "%Y-%m-%d") between "'.$dt_ini.'" and "'.$dt_fim.'"
        ');
    
        $res = 0;
    
        foreach ($dados as $dado) {
            $res = $dado->total;
        }
    
        return $res;
    
    }


    public static function usuariosClientesStatus($dt_ini, $dt_fim){

        $dados = null;

        $dados = DB::select('

        SELECT 
            proposta.id proposta ,
            CLIENTE.NOME nome_cliente, 
            USERS.NAME nome  
        FROM 
            CLIENTE, 
            PROPOSTA, 
            USERS
            
        WHERE 
            CLIENTE.ID = PROPOSTA.cliente_id
            AND   CLIENTE.user_id = USERS.ID
            and str_to_date(proposta.created_at, "%Y-%m-%d") between "'.$dt_ini.'" and "'.$dt_fim.'"
        order by 
            users.name asc 
        
        ');
    
      return $dados;


    }



    public static function cor($proposta){

        $dados = DB::select('
        SELECT 
            CASE 
            WHEN PROPOSTA.SN_ATIVO = 1 THEN "rgb(241, 206, 4)" 
            WHEN PROPOSTA.SN_ATIVO = 0 AND (PROPOSTA.MOTIVO_FINALIZACAO_ID <> 1) THEN "rgb(194, 10, 47)"  
            WHEN PROPOSTA.SN_ATIVO = 0 AND (PROPOSTA.MOTIVO_FINALIZACAO_ID = 1) THEN "rgb(44, 138, 106)" END COR
        FROM PROPOSTA, LOG_PROPOSTA
        WHERE PROPOSTA.ID = LOG_PROPOSTA.PROPOSTA_ID
        AND PROPOSTA.ID = '.$proposta.'
        ORDER by log_proposta.id desc
        limit 1
        ');

        $res = 0;
    
        foreach ($dados as $dado) {
            $res = $dado->COR;
        }
    
        return $res;
    

    }


}