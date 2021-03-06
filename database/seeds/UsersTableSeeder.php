<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin',
            'cargo_id' => 1,
            'cpf' => '000.000.000-00',
            'rg' => '0.000.000',
            'email_verified_at' => now(),
            'password' => Hash::make('Sucesso@123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
