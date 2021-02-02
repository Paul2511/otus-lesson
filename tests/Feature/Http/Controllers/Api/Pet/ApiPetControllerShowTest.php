<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Pet;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\UserGenerator;

class ApiPetControllerShowTest extends TestPet
{
    /**
     * Клиент получает своего питомца
     * @group pet
     * @group petShow
     */
    public function testClientSuccess200()
    {
        $user = $this->currentUser();

        $pets = $this->generatePet(3);
        $pet = $pets->random(1)->all();
        $pet = $pet[0];

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET, ['pet'=>$pet]) );

        $result = json_decode($response->getContent(), true);

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data']);

        $this->assertEquals($pet->id, $result['data']['id']);
    }

    /**
     * Клиент получает НЕ своего питомца
     * @group pet
     * @group petShow
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();
        $myPets = $this->generatePet(5);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(3, [
            'client_id' => $anotherUser->client->id
        ]);
        $anotherPet = $anotherPets->random(1)->all();
        $anotherPet = $anotherPet[0];

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET, ['pet'=>$anotherPet]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }


    /**
     * Админ получает питомца любого клиента
     * @group pet
     * @group petShow
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(2, [
            'client_id' => $anotherUser->client->id
        ]);
        $anotherPet = $anotherPets->random(1)->all();
        $anotherPet = $anotherPet[0];

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET, ['pet'=>$anotherPet]));

        $result = json_decode($response->getContent(), true);

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data']);

        $this->assertEquals($anotherPet->id, $result['data']['id']);
    }

    /**
     * Питомец не найден
     * @group pet
     * @group petShow
     */
    public function testPetNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(2, [
            'client_id' => $anotherUser->client->id
        ]);

        $fakePet = Pet::factory()->makeOne([
            'id' => 1000
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET, [
            'pet' => $fakePet
        ]));

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('pet.notFound')]);
    }

}