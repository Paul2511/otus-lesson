<?php


namespace Tests\Feature\Http\Controllers\Admin\Users;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\Auth\AuthRoutes;
use App\Services\Users\Repositories\EloquentUserRepository;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminUsersControllerStoreTest extends TestCase
{
    private function getEloquentUserRepository (): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }
    /**
     * @group admin
     * @group store
     */
    public function testRedirectsNotAuthenticatedUsers()
    {
        $response = $this
            ->post(
            route(AdminRoutes::ADMIN_USERS_STORE)
        );
        $response->assertStatus(302)->assertRedirect(AuthRoutes::AUTH_LOGIN);
    }
    /**
     * @group admin
     * @group store
     */
    public function testReturns403ForPlainUser()
    {
        $user=UsersGenerator::generatePlain();
        $data = array(
            'full_name' => 'Пользунов',
            'password' => '1z2x3c4v5b',
            'email' => 'qwert@qwerty.ru',
            'phone' => '81114564444',
        );
        $response = $this->actingAs($user)
            ->withHeaders( ['Accept' => 'application/json',
                            'X-Requested-With' =>'XMLHttpRequest'])
            ->post(
                route(AdminRoutes::ADMIN_USERS_STORE), $data
            );
        $response->assertForbidden();
    }

    /**
     * @group admin
     * @group store
     */
    public function testStoreUser()
    {
        $user=UsersGenerator::generateAdmin();
        $data = array(
            'full_name' => 'Пользунов',
            'password' => '1z2x3c4v5b',
            'email' => 'qwert@qwerty.ru',
            'phone' => '81114564444',
        );
        $this->from(route(AdminRoutes::ADMIN_USERS_CREATE))
            ->actingAs($user)
            ->withHeaders( ['Accept' => 'application/json',
                            'X-Requested-With' =>'XMLHttpRequest'])
            ->post(
            route(AdminRoutes::ADMIN_USERS_STORE), $data
        );
        $createdUser = $this->getEloquentUserRepository()->findByEmail($data['email']);
        $this->assertNotNull($createdUser);
    }

    /**
     * @group admin
     * @group store
     */
    public function testStore422IfNoEmail()
    {
        $user=UsersGenerator::generateAdmin();
        $data = array(
            'full_name' => 'Пользунов',
            'password' => '1z2x3c4v5b',
            'phone' => '81114564444',
        );
        $response = $this->actingAs($user)
            ->withHeaders( ['Accept' => 'application/json',
                            'X-Requested-With' =>'XMLHttpRequest'])
            ->post(
            route(AdminRoutes::ADMIN_USERS_STORE), $data
        );
        $response->assertStatus(422);
    }

}
