<?php


namespace Tests\Feature\Http\Controllers\Api\User;

use App\Models\User;
use App\Services\Users\UserService;
use App\States\User\Role\AdminUserRole;
use App\States\User\Role\ManagerUserRole;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
use App\Services\Users\Repositories\UserRepository;
use App\States\User\Status\BlockedUserStatus;
class ApiUserControllerUpdateTest extends TestCase
{
    use AuthAttach;

    private static $uri = 'api/users/';

    private function getUserService(): UserService
    {
        return app(UserService::class);
    }

    /**
     * Клиент успешно обновляет одно свое поле
     * @group user
     * @group userUpdate
     */
    public function testClientUpdateSuccess200()
    {
        $user = $this->currentUser();
        $newLastName = 'Константинопольский';
        $newName = [
            'lastName'=>$newLastName,
            'firstName'=>$user->name->firstName,
            'middleName'=>$user->name->middleName,
        ];
        $data = ['name'=>$newName];

        $response = $this->tokenHeader()->json('POST', self::$uri . $user->id, $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['user'])
            ->assertJson(['success' => true]);

        $newUser = $this->getUserService()->findUser($user->id);

        $this->assertEquals($newUser->name->lastName, $newLastName);
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
            'status'=>BlockedUserStatus::$name
        ];

        $response = $this->tokenHeader()->json('POST', self::$uri . $user->id, $data);

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
            'email'=>'newemail@email.com'
        ];
        $response = $this->tokenHeader()->json('POST', self::$uri . $anotherUser->id, $data);

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
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();

        $newLastName = 'Константинопольский';
        $newName = [
            'lastName'=>$newLastName,
            'firstName'=>$anotherUser->name->firstName,
            'middleName'=>$anotherUser->name->middleName,
        ];
        $data = ['name'=>$newName];
        $response = $this->tokenHeader()->json('POST', self::$uri . $anotherUser->id, $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['user'])
            ->assertJson(['success' => true]);

        $newUser = $this->getUserService()->findUser($anotherUser->id);

        $this->assertEquals($newUser->name->lastName, $newLastName);
    }


    /**
     * Админ может обновлять статус
     * @group user
     * @group userUpdate
     */
    public function testAdminUpdateRoleORStatus200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();

        $data = [
            'status'=>BlockedUserStatus::$name
        ];

        $response = $this->tokenHeader()->json('POST', self::$uri . $anotherUser->id, $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['user'])
            ->assertJson(['success' => true]);

        $newUser = $this->getUserService()->findUser($anotherUser->id);

        $oldField = $data['status'];
        $newField = $newUser->status->getValue();
        $this->assertEquals($oldField, $newField);
    }


    /**
     * Неверный статус
     * @group user
     * @group userUpdate
     */
    public function testUpdateStatusWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();

        $data = [
            'status'=>'test_status'
        ];

        $response = $this->tokenHeader()->json('POST', self::$uri . $anotherUser->id, $data);

        $response
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['status']);
    }

    /**
     * Пользователь не найден
     * @group user
     * @group userUpdate
     */
    public function testUserNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $data = [
            'status'=>BlockedUserStatus::$name
        ];

        $response = $this->tokenHeader()->json('POST', self::$uri . '2', $data);

        $response->assertStatus(404)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('user.notFound')]);
    }

    /**
     * Отсутствует пользователь в запросе
     * @group user
     * @group userUpdate
     */
    public function testWithoutUser404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $data = [
            'status'=>BlockedUserStatus::$name
        ];
        $response = $this->tokenHeader()->json('POST', self::$uri, $data);

        $response->assertStatus(404)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('main.urlNotFound')]);
    }

}