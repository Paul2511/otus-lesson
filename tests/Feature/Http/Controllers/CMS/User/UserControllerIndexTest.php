<?php


namespace Http\Controllers\CMS\User;


use App\Services\Users\Repository\EloquentUserRepository;
use Illuminate\Http\Response;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UserControllerIndexTest extends TestCase
{

    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }

    /**
     * @group http
     * @group user
     */
    public function testIndexRedirectNotAuthUsers()
    {
        $response = $this->get(route('user.index'));
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group user
     */
    public function testIndexReturns200()
    {
        $user = UserGenerator::generateAdmin();
        $response = $this->actingAs($user)->get(route('user.index'));
        $response->assertStatus(Response::HTTP_OK);

        $users = $this->getEloquentUserRepository()->search();
        $this->assertNotNull($users);
    }

}
