<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;

use App\Http\Requests\PostagemRequest;

class SiteController extends Controller
{
    public function index(){

        $postagens = Postagem::where('sn_ativo',true)
        ->with('usuarios')
        ->get();

       return view('site.index', compact('postagens'));

    }


    public function index_cad(){
        $title = 'Postagens';
        $postagens = Postagem::with('usuarios')
        ->paginate(10);

       return view('site.lista', compact('postagens','title'));

    }

    
    public function novaPostagem(){

        $title = 'Nova Postagem';

       return view('site.cadastro', compact('title'));

    }

    public function editarPostagem(Request $request){
        $title = 'Editar Postagem';
        $postagem_id = $request->input('postagem_id');

        $postagens = Postagem::where('id',$postagem_id)->get();

        return view('site.editar', compact('title', 'postagens'));
    }

    public function updatePostagem(PostagemRequest $request){

        

        $arquivo = $request->file('file');
        
        $dados = Postagem::find($request->input('postagem_id'));

        if ($arquivo != null){
            $filename = time().'.'.$arquivo->extension();
            // $filePath = public_path() . '../../../domains/imobiliariaalpha.com/public_html/files/uploads/';
            $filePath = public_path() . '/files/site/uploads/';
            $nameOriginal = $arquivo->getClientOriginalName();
            $arquivo->move($filePath, $filename);
            $dados->imagem = $filename;
        }
        
        $dados->titulo = $request->input('titulo');
        $dados->sub_titulo = $request->input('subTitulo');
        $dados->data = $request->input('data');
        $dados->descricao = $request->input('descricao');
        $dados->user_id = auth()->user()->id;
        
        $dados->save();
        
        if ($dados){

            $response = [
                "success"   => true,
                "message"   => "Postagem editada com sucesso!."
            ];

            return redirect()->route('cadPostagem')->with('success', $response['message']);

        }else{

            $response = [
                "success"   => false,
                "message"   => "Um erro ocorreu ao editar a postagem."
            ];

            return redirect()->route('cadPostagem')->with('error', $response['message']);

        }
    }

    public function storePostagem(PostagemRequest $request){

         $arquivo = $request->file('file');
 
        $filename = time().'.'.$arquivo->extension();
        // $filePath = public_path() . '../../../domains/imobiliariaalpha.com/public_html/files/uploads/';
        $filePath = public_path() . '/files/site/uploads/';
        $nameOriginal = $arquivo->getClientOriginalName();
        $arquivo->move($filePath, $filename);


        $postagem = Postagem::create([
        'titulo' => $request->input('titulo'),
        'sub_titulo' => $request->input('subTitulo'),
        'data' => $request->input('data'),
        'imagem' => $filename,
        'descricao' => $request->input('descricao'),
        'user_id' => auth()->user()->id,
        ]);



        if ($postagem){

            $response = [
                "success"   => true,
                "message"   => "Postagem cadastrada com sucesso!."
            ];

            return redirect()->route('cadPostagem')->with('success', $response['message']);

        }else{

            $response = [
                "success"   => false,
                "message"   => "Um erro ocorreu ao cadastrar a postagem."
            ];

            return redirect()->route('cadPostagem')->with('error', $response['message']);

        }



    }


    public function desabilitarPostagem(Request $request){

        $ativaDesativas = Postagem::where('id',$request->input('postagem_id'))->get();

        foreach ($ativaDesativas as $ativaDesativa) {
            $opcao = $ativaDesativa->sn_ativo;
        }

        $dados = Postagem::find($request->input('postagem_id'));

        $dados->sn_ativo = !$opcao;
        
        $dados->save();
        
        if ($dados){

            $response = [
                "success"   => true,
                "message"   => "Postagem desabilitada com sucesso!."
            ];

            return redirect()->route('cadPostagem')->with('success', $response['message']);

        }else{

            $response = [
                "success"   => false,
                "message"   => "Um erro ocorreu ao desabilitar a postagem."
            ];

            return redirect()->route('cadPostagem')->with('error', $response['message']);

        }
    }
}
