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
            'password' => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'usuario01',
            'email' => 'usuario01',
            'cargo_id' => 2,
            'cpf' => '101.000.000-00',
            'rg' => '0.000.000',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('users')->insert([
            'name' => 'usuario02',
            'email' => 'usuario02',
            'cargo_id' => 2,
            'cpf' => '102.000.000-00',
            'rg' => '0.000.000',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
