<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\States\User\Role\AdminUserRole;
use Tests\Generators\UserGenerator;
use App\Models\User;
class ApiPetControllerIndexTest extends TestPet
{
    private static $uri = 'api/pets/user/';

    /**
     * Клиент получает листинг своих питомцев
     * @group pet
     * @group petIndex
     */
    public function testClientSuccess200()
    {
        $user = $this->currentUser();

        $pets = $this->generatePet(3);

        $response = $this->tokenHeader()->json('get', self::$uri . $user->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['pets'])
            ->assertJsonCount(3, 'pets')
            ->assertJson(['success' => true]);
    }

    /**
     * У клиента нет питомцев
     * @group pet
     * @group petIndex
     */
    public function testClientNoPetsSuccess200()
    {
        $user = $this->currentUser();

        $response = $this->tokenHeader()->json('get', self::$uri . $user->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['pets'])
            ->assertJsonCount(0, 'pets')
            ->assertJson(['success' => true]);
    }

    /**
     * Клиент получает листинг НЕ своих питомцев
     * @group pet
     * @group petIndex
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();
        $myPets = $this->generatePet(5);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(3, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', self::$uri . $anotherUser->id);

        $response->assertStatus(403)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ получает питомцев любого клиента
     * @group pet
     * @group petIndex
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(2, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', self::$uri . $anotherUser->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['pets'])
            ->assertJsonCount(2, 'pets')
            ->assertJson(['success' => true]);
    }

    /**
     * Пользователь не найден
     * @group pet
     * @group petIndex
     */
    public function testUserNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', self::$uri . '2');

        $response->assertStatus(404)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('user.notFound')]);
    }

    /**
     * Отсутствует пользователь в запросе
     * @group pet
     * @group petIndex
     */
    public function testWithoutUser404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', self::$uri);

        $response->assertStatus(404)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('main.urlNotFound')]);
    }
}