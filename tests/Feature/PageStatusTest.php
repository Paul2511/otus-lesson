<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PageStatusTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

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

    public function testNotAuthUser302StatusOnUserPage()
    {
        $response = $this->get(route('user.index'));

        $response->assertStatus(302)->assertRedirect(route('user.login'));
    }

    public function testAuthUser200StatusOnUserPage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get(route('user.index'));
        $response->assertStatus(200);
    }


    public function testNotAuthUser302StatusOnTaskPage()
    {
        $response = $this->get(route('task.index'));

        $response->assertStatus(302)->assertRedirect(route('user.login'));
    }

    public function testAuthUser200StatusOnTaskPage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get(route('task.index'));
        $response->assertStatus(200);
    }

    public function testNotAuthUser302StatusOnKnowledgePage()
    {
        $response = $this->get(route('knowledge.index'));

        $response->assertStatus(302)->assertRedirect(route('user.login'));
    }

    public function testAuthUser200StatusOnKnowledgePage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get(route('knowledge.index'));
        $response->assertStatus(200);
    }

    public function testNotAuthUser302StatusOnClientPage()
    {
        $response = $this->get(route('client.index'));

        $response->assertStatus(302)->assertRedirect(route('user.login'));
    }

    public function testAuthUser200StatusOnClientPage()
    {
        $user = User::factory()->create(["role" => 'manager']);

        $response = $this->actingAs($user)
                         ->get(route('client.index'));
        
        $response->assertStatus(200);
    }
}
