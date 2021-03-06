<?php

namespace Database\Factories;

use App\Models\Wikipage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'title' => $this->faker->company(),
            'parent_id' => $this->faker->randomDigit(),
            'description' => $this->faker->paragraph(4),
        ];
    }
}
