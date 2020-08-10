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
                'pontos' => '99999999999999999'
            ],
            [
                'ds_cargo' => 'START',
                'pontos' => '120000',
            ],  
            [
                'ds_cargo' => 'BONUS COACHING',
                'pontos' => '250000',
            ],  
            [
                'ds_cargo' => 'ESTAGIARIO',
                'pontos' => '400000',
            ],  
            [
                'ds_cargo' => 'VENDEDOR',
                'pontos' => '700000',
            ],  
            [
                'ds_cargo' => 'NEGOCIADOR',
                'pontos' => '1000000',
            ],  
            [
                'ds_cargo' => 'NEGOCIADOR GOLD',
                'pontos' => '1500000',
            ],  
            [
                'ds_cargo' => 'CONSULTOR',
                'pontos' => '2000000',
            ],  
            [
                'ds_cargo' => 'CONSULTOR GOLD',
                'pontos' => '2500000',
            ],  
            [
                'ds_cargo' => 'PERITO',
                'pontos' => '3000000',
            ],  
            [
                'ds_cargo' => 'EXECUTIVO',
                'pontos' => '3700000',
            ],  
            [
                'ds_cargo' => 'ESPECIALISTA',
                'pontos' => '4200000',
            ],  
            [
                'ds_cargo' => 'LIDER DE NEGOCIOS',
                'pontos' => '5000000',
            ],  
            [
                'ds_cargo' => 'ALPHA LIDER',
                'pontos' => '6000000',
            ], 

                 
            
        ];

        foreach ($cargos as $cargo) {
            
            Cargos::create($cargo);

        }
    }
}
