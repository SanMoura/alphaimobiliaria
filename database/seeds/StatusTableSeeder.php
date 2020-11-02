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
                'tp_status' => 'C',
                
            ],
            [
                'ds_status' => 'Agendou Visita',
                'tp_status' => 'C',
                
            ],
            [
                'ds_status' => 'Visita Efetuada',
                'tp_status' => 'C',
                
            ],
            [
                'ds_status' => 'Desistencia/Cancelamento',
                'tp_status' => 'C',
                
            ],            
            [
                'ds_status' => 'Proposta',
                'tp_status' => 'C',
                
            ],
            [
                'ds_status' => 'Aprovado',
                'tp_status' => 'P',
                
            ],
            [
                'ds_status' => 'Assinatura',
                'tp_status' => 'P',
                
            ],
            [
                'ds_status' => 'Entrega de Chaves',
                'tp_status' => 'P',
                
            ],
            
        ];

        foreach ($status as $stat) {
            
            status::create($stat);

        }
    }
}
