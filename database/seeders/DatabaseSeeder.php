<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@onlinestore.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'balance' => 10000,
            ],
        );

        User::updateOrCreate(
            ['email' => 'client@onlinestore.test'],
            [
                'name' => 'Client',
                'password' => Hash::make('password'),
                'role' => 'client',
                'balance' => 5000,
            ],
        );

        $products = [
            [
                'name' => 'Game',
                'description' => 'An awesome video game for your collection.',
                'image' => 'game.png',
                'price' => 120,
            ],
            [
                'name' => 'Safe',
                'description' => 'A strong safe for your most important items.',
                'image' => 'safe.png',
                'price' => 250,
            ],
            [
                'name' => 'Submarine',
                'description' => 'A compact submarine for adventurous shoppers.',
                'image' => 'submarine.png',
                'price' => 999,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product,
            );
        }
    }
}
