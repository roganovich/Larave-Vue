<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Point>
 */
class PointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $thumb = '';
        $public = 'public';
        $base_dir = '/uploads/images/points/';
        $product_path = $base_dir . date('Ymd') . '/';
        if (!file_exists($public . $base_dir)) {
            mkdir($public . $base_dir);
            if (!file_exists($public . $product_path)) {
                mkdir($public . $product_path);
            }
        }
        //$thumb = $product_path . $this->faker->image($public . $product_path, 640, 480, null, false);

        $images = [];
        for ($i = 0; $i <= rand(1, 5); $i++) {
            //$images[] = $product_path . $this->faker->image($public . $product_path, 640, 480, null, false);
        }

        $country = "Россия";
        $city = $this->faker->city();
        $address = $this->faker->address();
        $title = $this->faker->company;
        $slug = Str::slug($title, '_');
        $type_id = rand(1, 2);
        $desctiption = $this->faker->paragraph(4);
        $area = rand(15, 100);
        $days = rand(1, 3);
        $map_longitude = rand(58, 60) . '.' . rand(10, 90);
        $map_latitude = rand(28, 33) . '.' . rand(10, 90);

        return [
            'country' => $country,
            'city' => $city,
            'address' => $address,
            'title' => $title,
            'slug' => $slug,
            'type_id' => $type_id,
            'description' => $desctiption,
            'area' => $area,
            'days' => $days,
            'map_longitude' => $map_longitude,
            'map_latitude' => $map_latitude,
            'map_zoom' => 10,
            'thumb' => $thumb,
            'images' => json_encode($images),
        ];
    }
}
