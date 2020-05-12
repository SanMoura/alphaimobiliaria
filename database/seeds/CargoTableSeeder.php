<?php

use Illuminate\Database\Seeder;
use App\Models\Cargos;

class CargoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            [
                'ds_cargo' => 'Administrador',
            ],
            [
                'ds_cargo' => 'Corretor',
            ],       
            
        ];

        foreach ($cargos as $cargo) {
            
            Cargos::create($cargo);

        }
    }
}
