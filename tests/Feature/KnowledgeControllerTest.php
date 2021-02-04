<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KnowledgeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

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
}
