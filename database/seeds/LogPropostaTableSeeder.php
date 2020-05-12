<?php

use Illuminate\Database\Seeder;
use App\Models\log_proposta;

class LogPropostaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lpropostas = [
            [
                'dt_atendimento' => now(),
                'status_id' => 1,
                'proposta_id' => 1,
                
            ],
       
            
        ];

        foreach ($lpropostas as $lproposta) {
            
            log_proposta::create($lproposta);

        }
    }
}
