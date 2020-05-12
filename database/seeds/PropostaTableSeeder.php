<?php

use Illuminate\Database\Seeder;
use App\Models\proposta;

class PropostaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propostas = [
            [
                'cliente_id' => 1,
                'user_id' => 1,
                
            ],
       
            
        ];

        foreach ($propostas as $proposta) {
            
            proposta::create($proposta);

        }
    }
}
