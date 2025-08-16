<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Coca Cola 350ml',
                'description' => 'Refreshing cola drink',
                'price' => 5000,
                'barcode' => '123456789012',
                'stock_quantity' => 100,
                'is_active' => true,
            ],
            [
                'name' => 'Bread Loaf',
                'description' => 'Fresh white bread',
                'price' => 12000,
                'barcode' => '234567890123',
                'stock_quantity' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Milk 1L',
                'description' => 'Fresh whole milk',
                'price' => 15000,
                'barcode' => '345678901234',
                'stock_quantity' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Apples (1kg)',
                'description' => 'Red delicious apples',
                'price' => 25000,
                'barcode' => '456789012345',
                'stock_quantity' => 25,
                'is_active' => true,
            ],
            [
                'name' => 'Coffee Beans 250g',
                'description' => 'Premium arabica coffee beans',
                'price' => 75000,
                'barcode' => '567890123456',
                'stock_quantity' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Chocolate Bar',
                'description' => 'Dark chocolate 70% cocoa',
                'price' => 18000,
                'barcode' => '678901234567',
                'stock_quantity' => 75,
                'is_active' => true,
            ],
            [
                'name' => 'Orange Juice 1L',
                'description' => 'Fresh squeezed orange juice',
                'price' => 20000,
                'barcode' => '789012345678',
                'stock_quantity' => 40,
                'is_active' => true,
            ],
            [
                'name' => 'Pasta 500g',
                'description' => 'Italian spaghetti pasta',
                'price' => 8000,
                'barcode' => '890123456789',
                'stock_quantity' => 60,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            \App\Models\Item::create($item);
        }
    }
}
