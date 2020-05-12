<?php

namespace App\Http\Controllers\produtos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index(){
        
        return 'index';
    }    

    public function cadastro(Request $request){
        $title = 'Novo Produto';
        return view('produtos/cadastro', compact('title'));
    }    
}
