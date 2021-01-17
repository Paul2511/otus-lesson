<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testNonAuthorizedResponseStatus()
    {
        $response = $this->get('/home');

        $response->assertRedirect('/login');
    }

    public function testAuthorizedResponseStatus()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/home');

        $response->assertStatus(200);
    }
}
