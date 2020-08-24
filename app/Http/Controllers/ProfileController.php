<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use App\User;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Seu Perfil foi atualizado com sucesso.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Senha atualizada com sucesso.'));
    }

    public function fotoPerfil(Request $request){


        if($request->allFiles()) 
        {
         $arquivos = $request->allFiles();
 
            if ($arquivos['fotoPerfil']->extension() == 'jpg' || $arquivos['fotoPerfil']->extension() == 'png' || $arquivos['fotoPerfil']->extension() == 'PNG' || $arquivos['fotoPerfil']->extension() == 'jpeg'){

                $fotoAtuals = User::where('id', auth()->user()->id)->get();
                foreach ($fotoAtuals as $fotoAtual) {
                    
                    if ($fotoAtual->foto){
                        // unlink(public_path()."/files/fotos/{$fotoAtual->foto}");
                        unlink(public_path() . "/../../../domains/imobiliariaalpha.com/public_html/files/fotos/{$fotoAtual->foto}");
                    }
                    
                }

                $file = $arquivos;

                $filename = time() .'.'. $arquivos['fotoPerfil']->extension();
    
                $filePath = public_path() . '/../../../domains/imobiliariaalpha.com/public_html/files/fotos/';
                // public_path() . '/files/fotos/';
                
    
                $nameOriginal = $arquivos['fotoPerfil']->getClientOriginalName();
    
                if($file['fotoPerfil']->move($filePath, $filename)){

                    $dados = User::find(auth()->user()->id);
    
                    $dados->foto = $filename;
                    
                    $dados->save();
                };
    
                
                
    
                $response = [
                    "success"   => true,
                    "message"   => "Foto atualizada com sucesso!."
                ];
        

                return redirect()->route('profile.edit')->with('success', $response['message']);

            }else{
                $response = [
                    "success"   => false,
                    "message"   => "O arquivo precisar ser JPG ou PNG."
                ];
        
                return redirect()->route('profile.edit')->with('error', $response['message']);
            }

         }

         
         $response = [
            "success"   => false,
            "message"   => "Ocorreu um erro ao atualizar sua foto, tente novamente."
        ];

        return redirect()->route('profile.edit')->with('error', $response['message']);
        
      

    }
}
