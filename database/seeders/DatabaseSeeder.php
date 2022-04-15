<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        //\App\Models\Wikipage::factory(100)->create();
        //\App\Models\Point::factory(10)->create();
        \App\Models\ProductsBrand::factory(10)->create();
        \App\Models\ProductsCategory::factory(5)->create();
        \App\Models\Product::factory(50)->create();
    }
}
