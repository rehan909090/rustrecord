<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('genres')->insert([
            ['name' => 'Future Riddim'],
            ['name' => 'Melodic Dubstep'],
            ['name' => 'Colourbass'],
            ['name' => 'Hyperpop'],
            ['name' => 'Trap'],
            ['name' => 'Dubstep'],
            ['name' => 'Bass House'],
            ['name' => 'Drum and Bass'],
            ['name' => 'Future Bass'],
            ['name' => 'Glitch Hop'],
        ]);
    }
}
