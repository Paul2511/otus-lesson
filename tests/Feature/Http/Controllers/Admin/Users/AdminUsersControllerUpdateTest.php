<?php


namespace Tests\Feature\Http\Controllers\Admin\Users;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\Auth\AuthRoutes;
use App\Services\Users\Repositories\EloquentUserRepository;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminUsersControllerUpdateTest extends TestCase
{
    private function getEloquentUserRepository (): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }

    /**
     * @group admin
     * @group update
     */
    public function testRedirectsNotAuthenticatedUsers()
    {
        $userForUpdate=UsersGenerator::generatePlain();
        $response = $this
            ->patch(
                route(AdminRoutes::ADMIN_USERS_UPDATE, ['user'=> $userForUpdate->id])
            );
        $response->assertStatus(302)->assertRedirect(AuthRoutes::AUTH_LOGIN);
    }
    /**
     * @group admin
     * @group update
     */
    public function testReturns403ForPlainUser()
    {
        $user=UsersGenerator::generatePlain();
        $userForUpdate=UsersGenerator::generatePlain();

        $data = array(
            'full_name' => 'Пользунов',
            'password' => '1z2x3c4v5b',
            'email' => 'qwert@qwerty.ru',
            'phone' => '81114564444',
        );
        $response = $this->from(route(AdminRoutes::ADMIN_USERS_EDIT,['user'=>$userForUpdate->id]))
            ->actingAs($user)
            ->withHeaders( ['Accept' => 'application/json',
                            'X-Requested-With' =>'XMLHttpRequest'])
            ->patch(
                route(AdminRoutes::ADMIN_USERS_UPDATE,[
                    'user' => $userForUpdate->id
                ]), $data
            );
        $response->assertForbidden();
    }

    /**
     * @group admin
     * @group update
     */
    public function testUpdateUserEmail()
    {
        $user=UsersGenerator::generateAdmin();
        $userForUpdate=UsersGenerator::generatePlain();

        $data = array(
            'full_name' => 'Пользунов',
            'password' => '1z2x3c4v5b',
            'email' => 'qwert@qwerty.ru',
            'phone' => '81114564444',
        );
        $this->from(route(AdminRoutes::ADMIN_USERS_EDIT,['user'=>$userForUpdate->id]))
            ->actingAs($user)
            ->withHeaders( ['Accept' => 'application/json',
                            'X-Requested-With' =>'XMLHttpRequest'])
            ->patch(
            route(AdminRoutes::ADMIN_USERS_UPDATE,[
                'user' => $userForUpdate->id
            ]), $data
        );
        $updatedUser = $this->getEloquentUserRepository()->findById($userForUpdate->id);
        $this->assertEquals($updatedUser->email, $updatedUser->email);
    }

    /**
     * @group admin
     * @group update
     */
    public function testUpdateUserPassword()
    {
        $user=UsersGenerator::generateAdmin();
        $userForUpdate=UsersGenerator::generatePlain();

        $data = array(
            'full_name' => 'Пользунов',
            'password' => '1z2x3c4v5b',
            'email' => 'qwert@qwerty.ru',
            'phone' => '81114564444',
        );
        $response = $this->from(route(AdminRoutes::ADMIN_USERS_EDIT,['user'=>$userForUpdate->id]))
            ->actingAs($user)
            ->withHeaders( ['Accept' => 'application/json',
                            'X-Requested-With' =>'XMLHttpRequest'])
            ->patch(
                route(AdminRoutes::ADMIN_USERS_UPDATE,[
                    'user' => $userForUpdate->id
                ]), $data
            );
        $updatedUser = $this->getEloquentUserRepository()->findById($userForUpdate->id);
        $this->assertEquals($updatedUser->password, $updatedUser->password);
    }

    /**
     * @group admin
     * @group update
     */
    public function testUpdateReturnsErrorsIfNoEmail()
    {
        $user=UsersGenerator::generateAdmin();
        $userForUpdate=UsersGenerator::generatePlain();

        $data = array(
            'password' => '1z2x3c4v5b',
            'phone' => '81114564444',
        );
        $response = $this->from(route(AdminRoutes::ADMIN_USERS_EDIT,['user'=>$userForUpdate->id]))
            ->actingAs($user)
            ->withHeaders( ['Accept' => 'application/json',
                            'X-Requested-With' =>'XMLHttpRequest'])
            ->patch(
                route(AdminRoutes::ADMIN_USERS_UPDATE,[
                    'user' => $userForUpdate->id
                ]), $data
            )->assertJsonValidationErrors([
                'full_name']);
    }

}
