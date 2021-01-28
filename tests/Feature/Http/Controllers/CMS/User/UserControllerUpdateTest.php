<?php


namespace Http\Controllers\CMS\User;


use App\Services\Users\Repository\EloquentUserRepository;
use Illuminate\Http\Response;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UserControllerUpdateTest extends TestCase
{
    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }

    /**
     * @group http
     * @group user
     * @group update
     */
    public function testUpdateRedirectNotAuthUsers()
    {
        $user = UserGenerator::generateUser();
        $updateUser = UserGenerator::generateUser();
        $response = $this->get(route('user.update', ['user' => $user->id]), $updateUser->toArray());
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group user
     * @group update
     */
    public function testUpdateReturns404()
    {
        $admin = UserGenerator::generateAdmin();
        $user = UserGenerator::generateUser();
        $updateUser = UserGenerator::generateUser();

        $response = $this->actingAs($admin)->get(route('user.update', ['user' => 0]), $updateUser->toArray());
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @group http
     * @group user
     * @group update
     */
    public function testUpdateReturns200()
    {
        $admin = UserGenerator::generateAdmin();
        $user = UserGenerator::generateUser(['email' => 'blablabar@bla.com']);

        $response = $this->actingAs($admin)->put(route('user.update', ['user' => $user->id]), ['email' => 'blabla@bla.com']);
        $response->assertStatus(Response::HTTP_OK);
    }

}
