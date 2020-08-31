<?php

namespace App\Http\Controllers\relatorios;

use App\Models\cliente;
use App\Models\Fonte;
use App\Models\log_proposta;
use App\User;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class operacionalController extends Controller
{
    public function index(Request $request){

        $data_ini = $request->input('dt_ini');
        $data_fim = $request->input('dt_fim');

        $dados = User::where('cargo_id', '<>', 1)->get();

        $clientesFontes = DB::select('
        select 
            count(fonte_id) total, 
            ds_fonte
        from 
            cliente, 
            fonte
        where 
            fonte.id = cliente.fonte_id
        GROUP BY 
            ds_fonte
        order by 
            count(fonte_id) desc
        limit 3');

        return view('relatorios.operacional', compact('dados','clientesFontes','data_ini','data_fim'));
    }

    public function impressaoRelatorioOp(){

        $dados = User::where('cargo_id', '<>', 1)->get();

        $clientesFontes = DB::select('
        select 
            count(fonte_id) total, 
            ds_fonte
        from 
            cliente, 
            fonte
        where 
            fonte.id = cliente.fonte_id
        GROUP BY 
            ds_fonte
        order by 
            count(fonte_id) desc
        limit 3');

        return view('relatorios.imprimeOperacional', compact('dados','clientesFontes'));
    }

    

    
}
