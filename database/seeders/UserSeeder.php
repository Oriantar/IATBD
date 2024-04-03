<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name' => 'Melvin',
            'email' => 'melvin@melvin.melvin',
            'password' => Hash::make('melvin'),
            'isAdmin' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'timmetje',
            'email' => 'tim@tim.tim',
            'password' => Hash::make('tim'),
        ]);        
        DB::table('users')->insert([
            'name' => 'Max',
            'email' => 'max@max.max',
            'password' => Hash::make('max'),
        ]);
        DB::table('users')->insert([
            'name' => 'Gerben',
            'email' => 'gerben@gerben.gerben',
            'password' => Hash::make('gerben'),
        ]);
        DB::table('users')->insert([
            'name' => 'Daniel',
            'email' => 'daniel@daniel.daniel',
            'password' => Hash::make('daniel'),
        ]);
    }
}
