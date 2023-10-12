<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wishlist::factory(10)
            ->has(Product::factory()->count(5))
            ->create();
    }
}
