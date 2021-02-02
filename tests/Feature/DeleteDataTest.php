<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{User, Task, Knowledge, Client};

class DeleteDataTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testDeleteUser()
    {
        $user = User::factory()->create();
        $testUserId = $user->id;

        $response = $this->actingAs($user)
                        ->delete(route('user.destroy', $testUserId));

        $this->assertDatabaseMissing('users', ["id" => $testUserId]);

        $response->assertStatus(302);
    }

    public function testDeleteTask()
    {
        $user = User::factory()->create();
        $testUserId = $user->id;

        $task = Task::factory()->create(["user_id" => $testUserId]);
        $testTaskId = $task->id;

        $response = $this->actingAs($user)
                        ->delete(route('task.destroy', $testTaskId));

        $this->assertDatabaseMissing('tasks', ["id" => $testTaskId]);

        $response->assertStatus(302);
    }

    public function testDeleteKnowledge()
    {
        $user = User::factory()->create();
        $testUserId = $user->id;

        $knowledge = Knowledge::factory()->create(["user_id" => $testUserId]);
        $testKnowledgeId = $knowledge->id;

        $response = $this->actingAs($user)
                        ->delete(route('knowledge.destroy', $testKnowledgeId));

        $this->assertDatabaseMissing('knowledges', ["id" => $testKnowledgeId]);

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
