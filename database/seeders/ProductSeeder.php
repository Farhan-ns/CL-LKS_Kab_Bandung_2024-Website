<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    private $products = [
        ['name' => 'Popmie', 'price' => 6000, 'image' => 'popmie.png'],
        ['name' => 'Niu Green Tea Madu', 'price' => 8000, 'image' => 'niu.png'],
        ['name' => 'Oreo', 'price' => 340000, 'image' => 'oreo.png'],
        ['name' => 'Nuka Cola', 'price' => 15000, 'image' => 'nuka.png'],
        ['name' => 'Koin Seribu Vintage', 'price' => 1000, 'image' => 'koin.png'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->products as $product) {
            Product::create($product);
        }
    }
}
