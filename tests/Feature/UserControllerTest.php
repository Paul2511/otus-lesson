<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

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

    public function testDeleteUser()
    {
        $user = User::factory()->create();
        $testUserId = $user->id;

        $response = $this->actingAs($user)
                        ->delete(route('user.destroy', $testUserId));

        $this->assertDatabaseMissing('users', ["id" => $testUserId]);

        $response->assertStatus(302);
    }
}
