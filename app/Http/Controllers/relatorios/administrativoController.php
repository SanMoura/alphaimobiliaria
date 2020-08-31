<?php

namespace App\Http\Controllers\relatorios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class administrativoController extends Controller
{
    public function index(){
        return view('relatorios.administrativo');
    }
}
