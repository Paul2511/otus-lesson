<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\UserGenerator;
use App\Models\User;
class ApiPetControllerListTest extends TestPet
{
    /**
     * Только админ имеет право на листинг
     * @group pet
     * @group petList
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();
        $myPets = $this->generatePet(5);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(3, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::GET_ALL_PETS));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Только админ имеет право на листинг
     * @group pet
     * @group petList
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(2, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::GET_ALL_PETS));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(2, 'data');
    }
}