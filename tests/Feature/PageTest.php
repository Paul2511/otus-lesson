<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMainPage200Status()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testContactPage200Status()
    {
        $response = $this->get('/contacts');

        $response->assertStatus(200);
    }
}
