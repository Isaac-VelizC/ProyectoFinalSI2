<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'color' =>'Blanco',
        ]);
        Color::create([
            'color' =>'Negro',
        ]);
        Color::create([
            'color' =>'Rojo',
        ]);
        Color::create([
            'color' =>'Azul',
        ]);
        Color::create([
            'color' =>'Cafe',
        ]);
    }
}
