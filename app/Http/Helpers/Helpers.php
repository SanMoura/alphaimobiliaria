<?php
namespace App\Http\Helpers;
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


}