<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wikipage>
 */
class WikipageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $base_dir = DIRECTORY_SEPARATOR . 'wikipages' . DIRECTORY_SEPARATOR  . date('Ymd') . DIRECTORY_SEPARATOR ;
        $storage_path = storage_path('app'. DIRECTORY_SEPARATOR  .'public'. DIRECTORY_SEPARATOR  .'images' . $base_dir);

        File::makeDirectory($storage_path, $mode = 0777, true, true);
        $thumb = $this->faker->image($storage_path, 640, 480, null, false);

        return [
            'title' => $this->faker->company(),
            'parent_id' => $this->faker->randomDigit(),
            'description' => $this->faker->paragraph(4),
            'thumb' => ($thumb) ? $thumb  : NULL,
        ];
    }
}
