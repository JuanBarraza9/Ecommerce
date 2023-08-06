<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Color;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorsAndSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Generar tallas
        Size::create(['name' => 'S']);
        Size::create(['name' => 'M']);
        Size::create(['name' => 'L']);
        Size::create(['name' => 'XL']);

        // Generar colores
        Color::create(['name' => 'Red']);
        Color::create(['name' => 'Blue']);
        Color::create(['name' => 'Green']);
        Color::create(['name' => 'Yellow']);
        Color::create(['name' => 'Black']);
    }
}
