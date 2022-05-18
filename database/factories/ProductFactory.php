<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wikipage>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $max_categories = 5;
        $max_brands = 10;
        $categories = [
            rand(1, $max_categories),
            rand(1, $max_categories),
            rand(1, $max_categories),
        ];

        $root = '/var/www/';
        $public = 'public';
        $base_dir = '/uploads/images/products/';
        $product_path = $base_dir . date('Ymd') . '/';
        if (!file_exists($root . $public . $base_dir)) {
            mkdir($root . $public . $base_dir);
            if (!file_exists($root . $public . $product_path)) {
                mkdir($root . $public . $product_path);
            }
        }
        $thumb = $product_path . $this->faker->image($root . $public . $product_path, 640, 480, null, false);

        $images = [];
        for ($i = 0; $i <= rand(1, 5); $i++) {
            $images[] = $product_path . $this->faker->image($root . $public . $product_path, 640, 480, null, false);
        }

        $code = rand(111111, 999999);
        $brand_id = rand(1, $max_brands);
        $title = Str::ucfirst($this->faker->words(2, true));
        $description = $this->faker->paragraph(4);
        $categories = json_encode(array_values(array_unique($categories)));

        return [
            'code' => $code,
            'brand_id' => $brand_id,
            'title' => $title,
            'description' => $description,
            'categories' => $categories,
            'thumb' => $thumb,
            'images' => json_encode($images),
        ];
    }
}
