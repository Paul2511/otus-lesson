<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{User, Task, Knowledge, Client};
use Illuminate\Support\Facades\Hash;

class UpdateDataTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        //$this->withoutExceptionHandling();
        $user = User::factory()->create();
        $testUserId = $user->id;

        $data = [
            'name' => 'Test',
            'last_name' => 'Test',
            'patronymic' => 'Test',
            'email' => 'test@test.ru',
            'password' => 'test',
            'role' => User::DEVELOPER,
            'skills' => 'php|js|mysql'
        ];

        $response = $this->actingAs($user)
                        ->put(route('user.update', $testUserId), $data);

        $this->assertDatabaseHas('users', [
            'id' => $testUserId,
            'name' => 'Test',
            'last_name' => 'Test',
            'patronymic' => 'Test',
            'email' => 'test@test.ru',
            //'password' => 'test',
            'role' => User::DEVELOPER,
            'skills' => 'php|js|mysql'
        ]);

        $response->assertStatus(302);
    }

    public function testUpdateTask()
    {
        $user = User::factory()->create();
        $testUserId = $user->id;

        $task = Task::factory()->create(["user_id" => $testUserId]);
        $testTaskId = $task->id;

        $data = [
            'name' => 'TestTask',
            'description' => 'Test',
            'status' => 1
        ];

        $response = $this->actingAs($user)
                        ->put(route('task.update',  $testTaskId), $data);

        $this->assertDatabaseHas('tasks', [
            'id' => $testTaskId,
            'name' => 'TestTask',
            'description' => 'Test',
            'status' => 1,
            'user_id' => $testUserId
        ]);

        $response->assertStatus(302);
    }

    public function testUpdateKnowledge()
    {
        $user = User::factory()->create();
        $testUserId = $user->id;

        $knowledge = Knowledge::factory()->create(["user_id" => $testUserId]);
        $testKnowledgeId = $knowledge->id;

        $data = [
            'name' => 'TestKnowledge',
            'description' => 'Test',
            'data' => 'Test'
        ];

        $response = $this->actingAs($user)
                        ->put(route('knowledge.update',  $testKnowledgeId), $data);

        $this->assertDatabaseHas('knowledges', [
            'id' => $testKnowledgeId,
            'name' => 'TestKnowledge',
            'description' => 'Test',
            'data' => 'Test',
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
}
