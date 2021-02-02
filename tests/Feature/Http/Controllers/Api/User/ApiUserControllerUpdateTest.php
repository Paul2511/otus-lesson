<?php


namespace Tests\Feature\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
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

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_USER, ['user'=>$user]), $data);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

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

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_USER, ['user'=>$user]), $data);

        $response->assertStatus(403)
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
        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_USER, ['user'=>$anotherUser]), $data);

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ обновляет данные любого клиента
     * @group user
     * @group userUpdate
     */
    public function testAdminSuccess202()
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
        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_USER, ['user'=>$anotherUser]), $data);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

        $newUser = $this->getUserService()->findUser($anotherUser->id);

        $this->assertEquals($newUser->name->lastName, $newLastName);
    }


    /**
     * Админ может обновлять статус
     * @group user
     * @group userUpdate
     */
    public function testAdminUpdateStatus200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();

        $data = [
            'status'=>BlockedUserStatus::$name
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_USER, ['user'=>$anotherUser]), $data);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

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

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_USER, ['user'=>$anotherUser]), $data);

        $response
            ->assertStatus(422)
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
        $fakeUser = User::factory()->makeOne([
            'id' => 1000
        ]);

        $data = [
            'status'=>BlockedUserStatus::$name
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_USER, [
            'user' => $fakeUser
        ]), $data);

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('user.notFound')]);
    }
}