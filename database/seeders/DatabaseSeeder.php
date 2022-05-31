<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Subscription;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(5)->create();
        Subscription::factory()->count(5)->create();
    }
}
