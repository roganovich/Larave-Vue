<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductsCategory>
 */
class ProductsCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $public = 'public';
        $base_dir = '/uploads/images/products_category/';
        $product_path = $base_dir . date('Ymd') . '/';
        if (!file_exists($public.$base_dir)) {
            mkdir($public.$base_dir);
            if (!file_exists($public.$product_path)) {
                mkdir($public.$product_path);
            }
        }
        $thumb = $product_path . $this->faker->image($public . $product_path, 640, 480, null, false);

        $title = Str::ucfirst($this->faker->words(rand(1, 2), true));
        $slug = Str::slug($title, '_');
        $desctiption = $this->faker->paragraph(4);

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $desctiption,
            'thumb' => $thumb,
        ];
    }
}
