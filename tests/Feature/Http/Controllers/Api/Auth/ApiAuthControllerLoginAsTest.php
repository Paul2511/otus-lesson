<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiAuthControllerLoginAsTest extends TestCase
{
    use AuthAttach;

    /**
     * Успешный вход админа под клиентом
     * @group auth
     * @group loginAs
     */
    public function testLoginAsSuccessfully200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $user = UserGenerator::generateClient([
            'email' => 'testclient@user.com'
        ]);

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_LOGIN_AS, [
            'userId'=>$user->id
        ]));

        $answer = json_decode($response->getContent(), true);

        $response
            ->assertJsonStructure(['accessToken'])
            ->assertJsonStructure(['userData'])
            ->assertStatus(Controller::JSON_STATUS_OK);

        $this->assertEquals($answer['userData']['id'], $user->id);
    }

    /**
     * Пользователь не найден
     * @group auth
     * @group loginAs
     */
    public function testUserNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $user = UserGenerator::generateClient([
            'email' => 'testclient@user.com'
        ]);

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_LOGIN_AS, [
            'userId'=>1000
        ]));

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('user.notFound')]);
    }

    /**
     * Клиент не имеет права входа
     * @group auth
     * @group loginAs
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $anotherUser = UserGenerator::generateClient();

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_LOGIN_AS, [
            'userId'=>$anotherUser->id
        ]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

}