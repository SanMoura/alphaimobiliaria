<?php

use Illuminate\Database\Seeder;
use App\Models\status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'ds_status' => 'Acompanhamento',
                
            ],
            [
                'ds_status' => 'Agendou Visita',
                
            ],
            [
                'ds_status' => 'Visita Efetuada',
                
            ],
            [
                'ds_status' => 'Assinatura',
                
            ],
            [
                'ds_status' => 'Entrega de Chaves',
                
            ],
            
        ];

        foreach ($status as $stat) {
            
            status::create($stat);

        }
    }
}
