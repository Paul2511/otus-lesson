<?php


namespace Http\Controllers;


use Tests\TestCase;

class DeskControllerIndexTest extends TestCase
{


    /**
     * @group http
     */
    public function testReturn200()
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

}
