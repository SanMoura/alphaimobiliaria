<?php

namespace App\Http\Controllers\propostas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\log_proposta;
use App\Models\Anexos;
use App\Models\PropostaUsers;

use App\Http\Requests\UploadRequest;

class PropostaLogController extends Controller
{
    
    public function store(Request $request){
    
        //dd($request->allFiles());

        $log_proposta = log_proposta::create([
            'status_id' => $request->input('status_id'),
            'proposta_id' => $request->input('proposta_id'),
            'valorImovel' => $request->input('valorImovel'),
            'imovel' => $request->input('imovel'),
            'dt_atendimento' => $request->input('dt_atendimento'),
            'observacoes' => $request->input('observacoes'),
        ]);

        
        $props = PropostaUsers::where('proposta_id', $request->input('proposta_id'))->get();
        foreach ($props as $prop) {
            $propostaUserId = $prop->id;
        }

        $dados = PropostaUsers::find($propostaUserId);

        $dados->user_id_adicional = $request->input('userAdicional');
        
        $dados->save();

        
       
       if($request->allFiles()) 
       {
        $arquivos = $request->allFiles()['file'];

        for ($i = 0; $i < count($arquivos); $i++){
            
                $file = $arquivos[$i];
                $filename = time() . '.'.$i.'.' . $arquivos[$i]->extension();
                // $filePath = public_path() . '../../../domains/imobiliariaalpha.com/public_html/files/uploads/';
                $filePath = public_path() . '/../../../domains/imobiliariaalpha.com/public_html/files/uploads/';
                $nameOriginal = $arquivos[$i]->getClientOriginalName();
                $file->move($filePath, $filename);


                $anexos = Anexos::create([
                    'log_proposta_id' => $log_proposta->id,
                    'nome' => $filename,
                    'nomeOriginal' => $nameOriginal,
                    'proposta_id' => $request->input('proposta_id'),
                ]);
            }
        
        }
 

        return redirect()->route('proposta.index', ['cliente_id' => $request->input('cliente_id_att') ]);

    }


    public function anexos(Request $request){

        $log_proposta_id = $request->only('log_proposta_id');
        $anexos = Anexos::where('log_proposta_id', $log_proposta_id)
        ->get();

        return $anexos;

    }

    public function anexos_finalizados(Request $request){

        $proposta_id = $request->only('proposta_id');
        
        $anexos = Anexos::where('proposta_id', $proposta_id)->get();

        return $anexos;

    }


}
