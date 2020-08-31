<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CargoTableSeeder::class,
            UsersTableSeeder::class,
            StatusTableSeeder::class,
            MenuTableSeeder::class,
            FontesTableSeeder::class,
            MotivoFinalizacaoTableSeeder::class,
        ]);
    }
}
