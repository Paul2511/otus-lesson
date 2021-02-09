<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Routes\Providers\Routes;
use App\Models\User;

class PromotionControllerIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexRedirectIfNotAutharized()
    {
        $response = $this->get(route(Routes::PROMOTIONS_INDEX));

        $response->assertStatus(302)->assertRedirect('/login');
    }
    
    public function testIndexAutharizedUser()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get(route(Routes::PROMOTIONS_INDEX));

        $response->assertStatus(403);
    }
    
    public function testIndexAutharizedUserAdmin()
    {
        $user = User::factory()->create([
            'level' => User::LEVEL_ADMIN
        ]);
        
        $response = $this->actingAs($user)->get(route(Routes::PROMOTIONS_INDEX));

        $response->assertStatus(200);
    }
    
    public function testIndex()
    {
        $promotions = PromotionGenerator::generatePromotion();
        
        $response = $this->get(route(Routes::PROMOTIONS_INDEX));

        $response->assertJson([
            'id' => $promotions-id,
            'title' => $promotions->title,
            'text' => $promotions->text,
            'validate' => $promotions->validate,
            'status' => $promotions->status,
            'created_at' => $promotions->created_at,
            'updated_at' => $promotions->updated_at
        ]);
    }
}
