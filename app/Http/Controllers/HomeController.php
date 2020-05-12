<?php

namespace App\Http\Controllers;
 
use App\Models\cliente;
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

        $propostas = proposta::where('sn_ativo', true)
                            ->with(['cliente' => function ($q){
                                $q->orderBy('nome');
                            }])
                            ->with('status')
                            ->where('user_id', auth()->user()->id)
                            ->paginate(5);

//        $menus = parent::menus();

        return view('dashboard', compact('propostas'));
    }
}
