<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ejemplo de datos de categorías
        $categories = [
            [
                'category_name' => 'Ropa',
                'category_slug' => 'ropa',
                'category_image' => 'ropa.jpg',
            ],
            [
                'category_name' => 'Calzado',
                'category_slug' => 'calzado',
                'category_image' => 'calzado.jpg',
            ],
            [
                'category_name' => 'Fitness',
                'category_slug' => 'mancuernas',
                'category_image' => 'mancuernas.jpg',
            ],
            // Agrega más categorías según tus necesidades
        ];
    
        // Insertar los datos en la tabla de categorías
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
