<?php

namespace Tests\Feature;

use App\Models\Wikipage;
use Tests\TestCase;

class WikiTest extends TestCase
{
    /**
     * List of wikipages
     *
     * @return void
     */
    public function test_wiki_list()
    {
        $response = $this->get(route('wikipages.index'));

        $response->assertStatus(200);
    }

    /**
     * Open wiki page
     *
     * @return void
     */
    public function test_wiki_show()
    {
        $item = Wikipage::first();
        $response = $this->get(route('wikipages.show', ['id' => $item->id]));

        $response->assertStatus(200);
    }
}
