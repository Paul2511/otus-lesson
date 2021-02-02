<?php


namespace Tests\Feature\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\User;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiUserControllerPetsTest extends TestCase
{
    use AuthAttach;

    /**
     * Клиент получает своих питомцев по такому запросу
     * @group user
     * @group pet
     * @group userPets
     */
    public function testClientSuccess200()
    {
        $user = $this->currentUser();
        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS, ['user'=>$user]));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data']);
    }

    /**
     * Клиент получает НЕ свои данные по такому запросу
     * @group user
     * @group pet
     * @group userPets
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $anotherUser = UserGenerator::generateClient();

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS, ['user'=>$anotherUser]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ получает данные любого клиента
     * @group user
     * @group pet
     * @group userPets
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS, ['user'=>$anotherUser]));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data']);
    }

    /**
     * Пользователь не найден
     * @group user
     * @group pet
     * @group userPets
     */
    public function testUserNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $fakeUser = User::factory()->makeOne([
            'id' => 1000
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS, [
            'user' => $fakeUser
        ]));

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('user.notFound')]);
    }
}