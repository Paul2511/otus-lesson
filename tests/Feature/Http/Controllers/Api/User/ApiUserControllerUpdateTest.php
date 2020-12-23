<?php


namespace Tests\Feature\Http\Controllers\Api\User;

use App\Models\User;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
use App\Services\Users\Repositories\UserRepository;
class ApiUserControllerUpdateTest extends TestCase
{
    use AuthAttach;

    private static $uri = 'api/users/';

    private function getUserRepository(): UserRepository
    {
        return app(UserRepository::class);
    }

    /**
     * Клиент успешно обновляет одно свое поле
     * @group user
     * @group userUpdate
     */
    public function testClientUpdateSuccess200()
    {
        $user = $this->currentUser();
        $data = [
            'data'=>[
                'email'=>'newemail@email.com'
            ]
        ];

        $response = $this->tokenHeader()->json('patch', self::$uri . $user->id, $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['user'])
            ->assertJson(['success' => true]);

        $newUser = $this->getUserRepository()->findUser($user->id);
        $oldField = $data['data']['email'];
        $newField = $newUser->email;
        $this->assertEquals($oldField, $newField);
    }

    /**
     * Клиент успешно обновляет одно свое поле из userDetail
     * @group user
     * @group userUpdate
     */
    public function testClientUpdateDetailSuccess200()
    {
        $user = $this->currentUser();
        $data = [
            'data'=>[
                'detail'=>[
                    'lastname'=>'Константинопольский'
                ]
            ]
        ];

        $response = $this->tokenHeader()->json('patch', self::$uri . $user->id, $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['user'])
            ->assertJson(['success' => true]);

        $newUser = $this->getUserRepository()->findUser($user->id);
        $oldField = $data['data']['detail']['lastname'];
        $newField = $newUser->userDetail->lastname;
        $this->assertEquals($oldField, $newField);
    }

    /**
     * Неверный емэйл
     * @group user
     * @group userUpdate
     */
    public function testClientUpdateEmailWrong422()
    {
        $user = $this->currentUser();
        $data = [
            'data'=>[
                'email'=>'newemail'
            ]
        ];

        $response = $this->tokenHeader()->json('patch', self::$uri . $user->id, $data);
        $response
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * Пустой емэйл
     * @group user
     * @group userUpdate
     */
    public function testClientUpdateEmailEmpty422()
    {
        $user = $this->currentUser();
        $data = [
            'data'=>[
                'email'=>''
            ]
        ];

        $response = $this->tokenHeader()->json('patch', self::$uri . $user->id, $data);
        $response
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * Не-админ не может обновлять роль
     * @group user
     * @group userUpdate
     */
    public function testNotAdminUpdateRole403()
    {
        $user = $this->currentUser();
        $data = [
            'data'=>[
                'role'=>User::ROLE_MANAGER
            ]
        ];

        $response = $this->tokenHeader()->json('patch', self::$uri . $user->id, $data);

        $response->assertStatus(403)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Не-админ не может обновлять статус
     * @group user
     * @group userUpdate
     */
    public function testNotAdminUpdateStatus403()
    {
        $user = $this->currentUser();
        $data = [
            'data'=>[
                'status'=>User::STATUS_NOT_ACTIVE
            ]
        ];

        $response = $this->tokenHeader()->json('patch', self::$uri . $user->id, $data);

        $response->assertStatus(403)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Клиент обновляет НЕ свои данные
     * @group user
     * @group userUpdate
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $anotherUser = UserGenerator::generateClient();

        $data = [
            'data'=>[
                'email'=>'newemail@email.com'
            ]
        ];
        $response = $this->tokenHeader()->json('patch', self::$uri . $anotherUser->id, $data);

        $response->assertStatus(403)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ обновляет данные любого клиента
     * @group user
     * @group userUpdate
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $anotherUser = UserGenerator::generateClient();

        $data = [
            'data'=>[
                'email'=>'newemail@email.com'
            ]
        ];
        $response = $this->tokenHeader()->json('patch', self::$uri . $anotherUser->id, $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['user'])
            ->assertJson(['success' => true]);

        $newUser = $this->getUserRepository()->findUser($anotherUser->id);
        $oldField = $data['data']['email'];
        $newField = $newUser->email;
        $this->assertEquals($oldField, $newField);
    }


    /**
     * Админ может обновлять роль или статус
     * @group user
     * @group userUpdate
     */
    public function testAdminUpdateRoleORStatus200()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $anotherUser = UserGenerator::generateClient();

        $data = [
            'data'=>[
                'role'=>User::ROLE_MANAGER,
                'status'=>User::STATUS_NOT_ACTIVE
            ]
        ];

        $response = $this->tokenHeader()->json('patch', self::$uri . $anotherUser->id, $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['user'])
            ->assertJson(['success' => true]);

        $newUser = $this->getUserRepository()->findUser($anotherUser->id);

        $oldField = $data['data']['role'];
        $newField = $newUser->role;
        $this->assertEquals($oldField, $newField);

        $oldField = $data['data']['status'];
        $newField = $newUser->status;
        $this->assertEquals($oldField, $newField);
    }

    /**
     * Неверная роль
     * @group user
     * @group userUpdate
     */
    public function testUpdateRoleWrong422()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $anotherUser = UserGenerator::generateClient();

        $data = [
            'data'=>[
                'role'=>'wrong',
            ]
        ];

        $response = $this->tokenHeader()->json('patch', self::$uri . $anotherUser->id, $data);

        $response
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['role']);
    }

    /**
     * Неверный статус
     * @group user
     * @group userUpdate
     */
    public function testUpdateStatusWrong422()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $anotherUser = UserGenerator::generateClient();

        $data = [
            'data'=>[
                'status'=>100,
            ]
        ];

        $response = $this->tokenHeader()->json('patch', self::$uri . $anotherUser->id, $data);

        $response
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['status']);
    }

    /**
     * Пользователь не найден
     * @group user
     * @group userShow
     */
    public function testUserNotFound404()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $data = [
            'data'=>[
                'email'=>'newemail@email.com'
            ]
        ];
        $response = $this->tokenHeader()->json('patch', self::$uri . '2', $data);

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

        $data = [
            'data'=>[
                'email'=>'newemail@email.com'
            ]
        ];
        $response = $this->tokenHeader()->json('patch', self::$uri, $data);

        $response->assertStatus(404)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('main.urlNotFound')]);
    }

}