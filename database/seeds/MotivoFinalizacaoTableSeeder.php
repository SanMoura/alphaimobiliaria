<?php

use Illuminate\Database\Seeder;
use App\Models\motivoFinalizacao;

class MotivoFinalizacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motivos = [
            [
                'ds_motivo' => 'Venda Concluída',
                
            ],
            [
                'ds_motivo' => 'Desistência',
                
            ],
            [
                'ds_motivo' => 'Não aprovação',
                
            ],
        ];

        foreach ($motivos as $motivo) {
            
            motivoFinalizacao::create($motivo);

        }
    }
}
