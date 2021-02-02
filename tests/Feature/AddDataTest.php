<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Support\Facades\Hash;

class AddDataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    protected $userService;

    public function testAddUser()
    {
        //$this->withoutExceptionHandling();
        $data = [
            'name' => 'Test',
            'last_name' => 'Test',
            'patronymic' => 'Test',
            'email' => 'test@test.ru',
            'password' => 'test',
            'role' => User::DEVELOPER,
            'skills' => 'test'
        ];

        $response = $this->post(route('user.store'), $data);

        $this->assertDatabaseHas('users', [
            'name' => 'Test',
            'last_name' => 'Test',
            'patronymic' => 'Test',
            'email' => 'test@test.ru',
            //'password' => 'test',
            'role' => User::DEVELOPER,
            'skills' => 'test'
        ]);

        $response->assertStatus(302);
    }

    public function testAddTask()
    {
        $user = User::factory()->create();
        $testUserId = $user->id;

        $data = [
            'name' => 'TestTask',
            'description' => 'Test',
            'status' => 1,
            'user_id' => $testUserId
        ];

        $response = $this->actingAs($user)
                        ->post(route('task.store'), $data);

        $this->assertDatabaseHas('tasks', [
            'name' => 'TestTask',
            'description' => 'Test',
            'status' => 1,
            'user_id' => $testUserId
        ]);

        $response->assertStatus(302);
    }

    public function testAddKnowledge()
    {
        $user = User::factory()->create();
        $testUserId = $user->id;

        $data = [
            'name' => 'TestKnowledge',
            'description' => 'Test',
            'data' => 'Test',
            'user_id' => $testUserId
        ];

        $response = $this->actingAs($user)
                        ->post(route('knowledge.store'), $data);

        $this->assertDatabaseHas('knowledges', [
            'name' => 'TestKnowledge',
            'description' => 'Test',
            'data' => 'Test',
            'user_id' => $testUserId
        ]);

        $response->assertStatus(302);
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
}
