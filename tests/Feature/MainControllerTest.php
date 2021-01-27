<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MainControllerTest extends TestCase
{
    public function testBasicResponseStatus()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
