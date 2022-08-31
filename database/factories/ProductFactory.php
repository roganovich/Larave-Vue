<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        $thumb = '';
        $max_categories = 5;
        $max_brands = 10;
        $categories = [
            rand(1, $max_categories),
            rand(1, $max_categories),
            rand(1, $max_categories),
        ];

        $base_dir = DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR;
        $storage_path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . $base_dir);

        File::makeDirectory($storage_path, $mode = 0777, true, true);
        $thumb = $this->faker->image($storage_path, 640, 480, null, false);

        $images = [];
        for ($i = 0; $i <= rand(1, 5); $i++) {
            $img_src = $this->faker->image($storage_path, 640, 480, null, false);
            if ($img_src)
                $images[] = $img_src;
        }

        $code = rand(111111, 999999);
        $brand_id = rand(1, $max_brands);
        $title = Str::ucfirst($this->faker->words(2, true));
        $description = $this->faker->paragraph(4);
        $categories = array_values(array_unique($categories));
        $price = rand(99, 9999);
        $slug = Str::slug($title, '_');

        return [
            'code' => $code,
            'brand_id' => $brand_id,
            'title' => $title,
            'description' => $description,
            'categories' => $categories,
            'thumb' => ($thumb) ? $thumb  : NULL,
            'images' => json_encode($images),
            'price' => $price,
            'slug' => $slug,
        ];
    }
}
