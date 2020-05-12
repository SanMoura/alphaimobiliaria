<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;

use App\Models\Cargos;
use App\User;


class UsuariosController extends Controller
{
    public function index(){
        $title = 'Usuarios';

        $usuarios = User::where('id', '!=' , 1)->paginate(10);

        return view('usuarios.index', compact('title','usuarios'));
    }


    public function editar( Request $request ){

        $usuario_id = $request->only('usuario_id');
        
        if ( $usuario_id['usuario_id'] == 1 ){

            return redirect()->route('usuario.index');

        }else{
            
            $title = 'Edição de Usuário';

            $cargos = Cargos::where('sn_ativo',true)->get();
    
            
    
            $usuarios = User::where('id',$usuario_id)->get();
    
            return view('usuarios/edicao', compact('title','usuarios','cargos'));
        }

        
    }


    
    public function cadastrarUsuario( Request $request ){

            
            $title = 'Cadastro de Usuário';

            $cargos = Cargos::where('sn_ativo',true)->get();
    
            
    
            return view('usuarios/cadastro', compact('title','cargos'));
        
    }


    public function updateUsuario( UsuarioUpdateRequest $request ){

        $dados = User::find($request->input('usuario_id'));

        $dados->name = $request->input('name');
        $dados->email = $request->input('email');
        $dados->cargo_id = $request->input('cargo');
        $dados->cpf = $request->input('cpf');
        $dados->rg = $request->input('rg');
        $dados->password = Hash::make($request->input('password'));
        
        $dados->save();
        
        return redirect()->route('usuario.index');
    }


    public function store (UsuarioRequest $request){
        
        
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'cargo_id' => $request->input('cargo'),
            'rg' => $request->input('rg'),
            'cpf' => $request->input('cpf'),
        ]);


        return redirect()->route('usuario.index');
    }
}
