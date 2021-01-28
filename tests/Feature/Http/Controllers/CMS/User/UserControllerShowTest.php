<?php


namespace Http\Controllers\CMS\User;


use Illuminate\Http\Response;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UserControllerShowTest extends TestCase
{
    /**
     * @group http
     * @group user
     * @group show
     */
    public function testIndexRedirectNotAuthUsers()
    {
        $user = UserGenerator::generateUser();
        $response = $this->get(route('user.show', ['user' => $user->id]));
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group user
     * @group show
     */
    public function testIndexReturns404()
    {
        $admin = UserGenerator::generateAdmin();
        $user = UserGenerator::generateUser();
        $response = $this->actingAs($admin)->get(route('user.show', ['user' => 155]));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @group http
     * @group user
     * @group show
     */
    public function testIndexReturns200()
    {
        $admin = UserGenerator::generateAdmin();
        $user = UserGenerator::generateUser();
        $response = $this->actingAs($admin)->get(route('user.show', ['user' => $user->id]));
        $response->assertStatus(Response::HTTP_OK);
    }

}
