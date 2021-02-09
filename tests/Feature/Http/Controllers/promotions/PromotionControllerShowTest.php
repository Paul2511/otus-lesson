<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Routes\Providers\Routes;

class PromotionControllerShowTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIfNotAuth()
    {
        $response = $this->get(route(Routes::PROMOTIONS_SHOW));

        $response->assertStatus(302)->assertRedirect('/login');
    }
    
     public function testShow()
    {
        $promotions = PromotionGenerator::generatePromotion();
        
        $response = $this->get(route(Routes::PROMOTIONS_SHOW));

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
