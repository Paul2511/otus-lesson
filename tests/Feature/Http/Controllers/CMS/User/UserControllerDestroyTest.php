<?php


namespace Http\Controllers\CMS\User;


use App\Services\Users\Repository\EloquentUserRepository;
use Illuminate\Http\Response;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UserControllerDestroyTest extends TestCase
{
    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }

    /**
     * @group http
     * @group user
     * @group destroy
     */
    public function testDestroyRedirectNotAuthUsers()
    {
        $user = UserGenerator::generateUser();
        $response = $this->get(route('user.destroy', ['user' => $user->id]));
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group user
     * @group destroy
     */
    public function testDestroyReturns404()
    {
        $admin = UserGenerator::generateAdmin();

        $response = $this->actingAs($admin)->get(route('user.destroy', ['user' => 155]));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @group http
     * @group user
     * @group destroy
     */
    public function testDestroyReturns200()
    {
        $admin = UserGenerator::generateAdmin();
        $user = UserGenerator::generateUser();
        $response = $this->actingAs($admin)->delete(route('user.destroy', ['user' => $user->id]));
        $response->assertStatus(Response::HTTP_OK);

    }

}
