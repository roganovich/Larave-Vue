<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    const COUNT_USERS = 10;
    const COUNT_WIKIPAGES = 100;
    const COUNT_PRODUCT_BRANDS = 10;
    const COUNT_PRODUCTS_CATEGORIES = 5;
    const COUNT_PRODUCTS = 50;
    const COUNT_POINTS = 10;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** Пользователи */
        //\App\Models\User::factory(self::COUNT_USERS)->create();

        /** Создаем права доступа */
        /* DB::table('users_roles')->insert([
             ['title' => 'Администратор', 'is_root' => 1],
             ['title' => 'Менеджер', 'is_root' => 0],
             ['title' => 'Контент', 'is_root' => 0],
         ]);*/

        /** Назначаем администратора */
        //DB::table('users')->where('id', '=', 1)->update(array('role_id' => 1));

        /** Текстовые страницы */
        //\App\Models\Wikipage::factory(self::COUNT_WIKIPAGES)->create();

        /** Производители товаров */
        //\App\Models\ProductsBrand::factory(self::COUNT_PRODUCT_BRANDS)->create();

        /** Категории товаров */
        //\App\Models\ProductsCategory::factory(self::COUNT_PRODUCTS_CATEGORIES)->create();

        /** Товары */
        \App\Models\Product::factory(self::COUNT_PRODUCTS)->create();

        /** Типы точек */
        //DB::table('points_types')->insert([['title' => 'Магазин'], ['title' => 'Склад']]);

        /** Точки выдачи товаров */
        //\App\Models\Point::factory(self::COUNT_POINTS)->create();

        /** Остатки товаров на каждоой точке */
        $datetime = date("Y-m-d H:i:s");
        $rest_insert_data = [];
        for ($i = 1; $i <= self::COUNT_POINTS; $i++) {
            for ($j = 1; $j <= self::COUNT_PRODUCTS; $j++) {
                $rest_insert_data[] = [
                    'product_id' => $j,
                    'point_id' => $i,
                    'qty' => rand(1, 10),
                    'created_at' => $datetime,
                    'updated_at' => $datetime,
                ];
            }
        }

        //DB::table('rests')->insert($rest_insert_data);
    }
}
