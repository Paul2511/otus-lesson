<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

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

    public function testAddClient()
    {
        //$this->withoutExceptionHandling();
        $user = User::factory()->create(["role" => "manager"]);
        $testUserId = $user->id;

        $data = [
            'name' => 'TestClient',
            'last_name' => 'Test',
            'patronymic' => 'Test',
            'interest_status' => 'dont know about service',
            'email' => 'test@test.ru',
            'addres' => 'Test',
            'phone' => '999',
            'wishes' => 'Test',
            'complaints' => 'Test',
            'selected_service' => 'Test',
            'user_id' => $testUserId
        ];

        $response = $this->actingAs($user)
                         ->post(route('client.store'), $data);

        $this->assertDatabaseHas('clients', [
            'name' => 'TestClient',
            'last_name' => 'Test',
            'patronymic' => 'Test',
            'interest_status' => 'dont know about service',
            'email' => 'test@test.ru',
            'addres' => 'Test',
            'phone' => '999',
            'wishes' => 'Test',
            'complaints' => 'Test',
            'selected_service' => 'Test',
            'user_id' => $testUserId
        ]);

        $response->assertStatus(302);
    }

    public function testUpdateClient()
    {
        $user = User::factory()->create(["role" => "manager"]);
        $testUserId = $user->id;

        $client = Client::factory()->create(["user_id" => $testUserId]);
        $testClientId = $client->id;

        $data = [
            'name' => 'TestClient',
            'last_name' => 'Test',
            'patronymic' => 'Test',
            'interest_status' => 'dont know about service',
            'email' => 'test@test.ru',
            'addres' => 'Test',
            'phone' => '999',
            'wishes' => 'Test',
            'complaints' => 'Test',
            'selected_service' => 'Test'
        ];

        $response = $this->actingAs($user)
                        ->put(route('client.update',  $testClientId), $data);
        $this->assertDatabaseHas('clients', [
            'id' => $testClientId,
            'name' => 'TestClient',
            'last_name' => 'Test',
            'patronymic' => 'Test',
            'interest_status' => 'dont know about service',
            'email' => 'test@test.ru',
            'addres' => 'Test',
            'phone' => '999',
            'wishes' => 'Test',
            'complaints' => 'Test',
            'selected_service' => 'Test',
            'user_id' => $testUserId
        ]);

        $response->assertStatus(302);
    }
    
    public function testDeleteClient()
    {
        $user = User::factory()->create(["role" => "manager"]);
        $testUserId = $user->id;

        $client = Client::factory()->create(["user_id" => $testUserId]);
        $testClientId = $client->id;

        $response = $this->actingAs($user)
                        ->delete(route('client.destroy', $testClientId));

        $this->assertDatabaseMissing('clients', ["id" => $testClientId]);

        $response->assertStatus(302);
    }
}
