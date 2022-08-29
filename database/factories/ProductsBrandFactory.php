<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductsBrand>
 */
class ProductsBrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $base_dir = DIRECTORY_SEPARATOR . 'products_brand' . DIRECTORY_SEPARATOR  . date('Ymd') . DIRECTORY_SEPARATOR ;
        $storage_path = storage_path('app'. DIRECTORY_SEPARATOR  .'public'. DIRECTORY_SEPARATOR  .'images' . $base_dir);

        File::makeDirectory($storage_path, $mode = 0777, true, true);
        $thumb = $this->faker->image($storage_path, 640, 480, null, false);

        $title = $this->faker->company;
        $slug = Str::slug($title, '_');
        $desctiption = $this->faker->paragraph(4);

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $desctiption,
            'thumb' => ($thumb) ? $thumb  : NULL,
        ];
    }
}
