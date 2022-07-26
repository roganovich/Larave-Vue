<?php

namespace Tests\Feature;

use App\Models\Point;
use App\Models\PointsType;
use Tests\TestCase;

class PointsTest extends TestCase
{
    /**
     * List of points
     *
     * @return void
     */
    public function test_points_list()
    {
        $response = $this->get(route('points.index'));

        $response->assertStatus(200);
    }

    /**
     * Open point page
     *
     * @return void
     */
    public function test_points_show()
    {
        $item = Point::first();
        $response = $this->get(route('points.show', ['slug' => $item->slug]));

        $response->assertStatus(200);
    }

    /**
     * Filter points by type
     *
     * @return void
     */
    public function test_points_filter_by_types()
    {
        $item = PointsType::first();
        $response = $this->get(route('points.index', ['type' => $item->title]));

        $response->assertStatus(200);
    }

    /**
     * Filter points by city
     *
     * @return void
     */
    public function test_points_filter_by_cities()
    {
        $item = Point::first();
        $response = $this->get(route('points.index', ['city' => $item->city]));

        $response->assertStatus(200);
    }
}
