<?php


namespace Tests\Feature\Http\Controllers\Api\User;

use App\Models\User;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiUserControllerShowTest extends TestCase
{
    use AuthAttach;

    private static $uri = 'api/users/';

    /**
     * Клиент получает свои данные
     * @group user
     * @group userShow
     */
    public function testClientSuccess200()
    {
        $user = $this->currentUser();
        $response = $this->tokenHeader()->json('get', self::$uri . $user->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['user'])
            ->assertJson(['success' => true]);
    }

    /**
     * Клиент получает НЕ свои данные
     * @group user
     * @group userShow
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $anotherUser = UserGenerator::generateClient();

        $response = $this->tokenHeader()->json('get', self::$uri . $anotherUser->id);

        $response->assertStatus(403)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ получает данные любого клиента
     * @group user
     * @group userShow
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $anotherUser = UserGenerator::generateClient();

        $response = $this->tokenHeader()->json('get', self::$uri . $anotherUser->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['user'])
            ->assertJson(['success' => true]);
    }

    /**
     * Пользователь не найден
     * @group user
     * @group userShow
     */
    public function testUserNotFound404()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $response = $this->tokenHeader()->json('get', self::$uri . '2');

        $response->assertStatus(404)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('user.notFound')]);
    }

    /**
     * Отсутствует пользователь в запросе
     * @group user
     * @group userShow
     */
    public function testWithoutUser404()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $response = $this->tokenHeader()->json('get', self::$uri);

        $response->assertStatus(404)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('main.urlNotFound')]);
    }
}