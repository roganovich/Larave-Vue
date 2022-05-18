<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** Пользователи */
        // \App\Models\User::factory(10)->create();
        /** Текстовые страницы */
        //\App\Models\Wikipage::factory(100)->create();
        /** Типы точек */
        //DB::table('points_types')->insert([['title' => 'Магазин'], ['title' => 'Склад']]);
        \App\Models\Point::factory(10)->create();
        //\App\Models\ProductsBrand::factory(10)->create();
        //\App\Models\ProductsCategory::factory(5)->create();
        //\App\Models\Product::factory(50)->create();
    }
}
