<?php

namespace Database\Seeders;

use App\Models\Talla;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TallasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Talla::create([
            'talla' =>'M',
        ]);
        Talla::create([
            'talla' =>'L',
        ]);
        Talla::create([
            'talla' =>'S',
        ]);
        Talla::create([
            'talla' =>'XXL',
        ]);
        Talla::create([
            'talla' =>'XL',
        ]);
        Talla::create([
            'talla' =>'XS',
        ]);
        Talla::create([
            'talla' =>'XXS',
        ]);
    }
}
