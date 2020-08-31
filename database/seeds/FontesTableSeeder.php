<?php

use Illuminate\Database\Seeder;
use App\Models\Fonte;

class FontesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fontes = [
            [
                'ds_fonte' => 'INSTAGRAM',
            ],
            [
                'ds_fonte' => 'FACEBOOK',
            ],
            [
                'ds_fonte' => 'PLACA',
            ],
            [
                'ds_fonte' => 'OLX',
            ],
            [
                'ds_fonte' => 'OUTROS',
            ],

            
        ];

        foreach ($fontes as $fonte) {
            
            Fonte::create($fonte);

        }
    }
}
