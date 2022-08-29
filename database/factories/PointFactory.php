<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use File;

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
        $base_dir = DIRECTORY_SEPARATOR . 'points' . DIRECTORY_SEPARATOR  . date('Ymd') . DIRECTORY_SEPARATOR ;
        $storage_path = storage_path('app'. DIRECTORY_SEPARATOR  .'public'. DIRECTORY_SEPARATOR  .'images' . $base_dir);

        File::makeDirectory($storage_path, $mode = 0777, true, true);
        $thumb = $this->faker->image($storage_path, 640, 480, null, false);

        $images = [];
        for ($i = 0; $i <= rand(1, 5); $i++) {
            $img_src = $this->faker->image($storage_path, 640, 480, null, false);
            if ($img_src)
                $images[] = $img_src;
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
            'thumb' => ($thumb) ? $thumb  : NULL,
            'images' => json_encode($images),
        ];
    }
}
