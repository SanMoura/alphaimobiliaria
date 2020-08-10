<?php

namespace App\Http\Controllers;
 

use App\Models\proposta;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {


        if (auth()->user()->cargo_id == 1){

            $propostas_home = proposta::where('sn_ativo', true)
            // ->with(['cliente' => function ($q){
            //     $q->orderBy('nome');
            // }])
            //->with('status')
            ->with(['proposta_users_relation' => function ($r){
                $r->with('usuarios_proposta');
            }])
            ->orderBy('created_at','desc')
            ->paginate(5);

            

        }else{

            $propostas_home = proposta::where('sn_ativo', true)
            ->join('proposta_users', 'proposta.id', '=', 'proposta_users.proposta_id')
            ->where('proposta_users.user_id', auth()->user()->id)
            ->paginate(5);
            
        }

        //  dd($propostas_home);

        return view('dashboard', compact('propostas_home'));
    }
}
