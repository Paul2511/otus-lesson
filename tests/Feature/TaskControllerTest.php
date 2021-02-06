<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

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
}
