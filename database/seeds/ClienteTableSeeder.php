<?php

use Illuminate\Database\Seeder;
use App\Models\cliente;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clis = [
            [
                'nome' => 'TESTE',
                'cpf' => 'TESTE',
                'rg' => 'TESTE',
                'fonte' => 'TESTE',
                'telefone' => 'TESTE',
                'renda' => 'TESTE',
                'data' => now(),
                
            ],
       
            
        ];

        foreach ($clis as $cli) {
            
            cliente::create($cli);

        }
    }
}
