<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wikipage>
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
        $root = '/var/www/';
        $public = 'public';
        $base_dir = '/uploads/images/products_category/';
        $product_path = $base_dir . date('Ymd') . '/';
        if (!file_exists($root . $public . $base_dir)) {
            mkdir($root . $public . $base_dir);
            if (!file_exists($root . $public . $product_path)) {
                mkdir($root . $public . $product_path);
            }
        }
        $thumb = $product_path . $this->faker->image($root . $public . $product_path, 640, 480, null, false);

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
