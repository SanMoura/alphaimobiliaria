<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'ds_menu' => 'DASHBOARD',
                'route' => 'home',
                'tipo' => 'N',
                'icone' => '<i class="ni ni-tv-2 style="color: #852E2A;"></i>',
                
            ],
            [
                'ds_menu' => 'CLIENTES',
                'route' => 'cliente.index',
                'tipo' => 'N',
                'icone' => '<i class="fas fa-user-plus" style="color: #852E2A;"></i>',
                
            ],
            [
                'ds_menu' => 'HISTÓRICO',
                'route' => 'historico',
                'tipo' => 'N',
                'icone' => '<i class="fas fa-folder-open" style="color: #852E2A;"></i>',
                
            ],                    
            [
                'ds_menu' => 'USUARIOS',
                'route' => 'usuario.index',
                'tipo' => 'N',
                'icone' => '<i class="fas fa-user-circle" style="color: #852E2A;"></i>',
                'cargo_id' => 1
                
            ], 
            [
                'ds_menu' => 'GERENCIAMENTO DE PONTOS',
                'route' => 'gerenciaPontos',
                'tipo' => 'N',
                'icone' => '<i class="fas fa-align-justify" style="color: #852E2A;"></i>',
                'cargo_id' => 1
                
            ], 
            [
                'ds_menu' => 'OPERACIONAL',
                'route' => 'relatorioOperacional',
                'tipo' => 'R',
                'icone' => '<i class="fas fa-building" style="color: #852E2A;"></i>',
                'cargo_id' => 1
                
            ], 
            [
                'ds_menu' => 'ADMINISTRATIVO',
                'route' => 'relatorioAdministrativo',
                'tipo' => 'R',
                'icone' => '<i class="fas fa-user-cog" style="color: #852E2A;"></i>',
                'cargo_id' => 1
                
            ], 

            
        ];

        foreach ($menus as $menu) {
            
            Menu::create($menu);

        }
    }
}
