<?php


namespace Http\Controllers\CMS\User;


use App\Services\Users\Repository\EloquentUserRepository;
use Illuminate\Http\Response;
use Tests\Generators\UserGenerator;
use Tests\Generators\UserRegisterGenerator;
use Tests\TestCase;

class UserControllerStoreTest extends TestCase
{
    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }

    /**
     * @group http
     * @group user
     * @group store
     */
    public function testStoreRedirectNotAuthUsers()
    {
        $user = UserRegisterGenerator::dataFromRegister();
        $response = $this->post(route('user.store'), $user);
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group user
     * @group store
     */
    public function testStoreReturn200()
    {
        $user = UserRegisterGenerator::dataFromRegister();
        $admin = UserGenerator::generateAdmin();
        $response = $this->actingAs($admin)->post(route('user.store'), $user);
        $response->assertStatus(Response::HTTP_CREATED);

        $createdUser = $this->getEloquentUserRepository()->findOrFail($response->json()['id']);
        $this->assertNotNull($createdUser);
    }

    /**
     * @group http
     * @group user
     * @group store
     */
    public function testStoreWrongData()
    {
        $user = UserRegisterGenerator::wrongDataFromRegister();
        $admin = UserGenerator::generateAdmin();
        $response = $this->actingAs($admin)->post(route('user.store'), $user);
        $response->assertStatus(Response::HTTP_FOUND);
    }

}
