<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PromotionControllerUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdate()
    {
       $user = User::factory()->create([
            'level' => User::LEVEL_ADMIN
        ]);
       
       $data = [
           'title' => 'New Title',
           'text' => 'New Text',
           'validate' => '2021-05-31',
           'status' => 0,
       ];
        
        $response = $this->actingAs($user)->post(route(Routes::PROMOTIONS_INDEX),$data);

        $response->assertStatus(200);
        
        $response->assertDatabaseHas('promotions',['name'=>$data]);
    }
    
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
}
