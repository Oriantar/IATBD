<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('species')->insert([
            'kind' => 'hond',
        ]);
        DB::table('species')->insert([
            'kind' => 'kat',
        ]);
        DB::table('species')->insert([
            'kind' => 'vis',
        ]);
        DB::table('species')->insert([
            'kind' => 'krokodil',
        ]);
        DB::table('species')->insert([
            'kind' => 'vogel',
        ]);
        DB::table('species')->insert([
            'kind' => 'hamster',
        ]);
        DB::table('species')->insert([
            'kind' => 'cavia',
        ]);
    }
}
