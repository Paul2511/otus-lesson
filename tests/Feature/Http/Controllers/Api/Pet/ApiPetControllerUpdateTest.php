<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Pet;
use App\Models\PetType;
use App\Services\Pets\PetService;
use App\States\User\Role\AdminUserRole;
use App\States\User\Role\ClientUserRole;
use Tests\Generators\UserGenerator;

class ApiPetControllerUpdateTest extends TestPet
{

    protected function getPetService(): PetService
    {
        return app(PetService::class);
    }

    /**
     * Клиент успешно обновляет своего питомца
     * @group pet
     * @group petUpdate
     */
    public function testClientSuccess202()
    {
        $user = $this->currentUser();
        $pets = $this->generatePet(3);

        $pet = $pets->random(1)->all();
        $pet = $pet[0];

        $newName = 'Гриня';
        $payload = [
            'name' => $newName
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::UPDATE_PET, ['pet'=>$pet]), $payload);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

        $newPet = $this->getPetService()->findPet($pet->id);
        $this->assertEquals($newPet->name, $newName);
    }

    /**
     * pet_type должно присутствовать в базе
     * @group pet
     * @group petUpdate
     */
    public function testWrongPetType422()
    {
        $pets = $this->generatePet(3);

        $pet = $pets->random(1)->all();
        $pet = $pet[0];

        $newName = 'Гриня';
        $payload = [
            'name' => $newName,
            'pet_type_id'=>1000
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::UPDATE_PET, ['pet'=>$pet]), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['pet_type_id']);
    }

    /**
     * Неверное поле sex
     * @group pet
     * @group petUpdate
     */
    public function testWrongSex422()
    {
        $pets = $this->generatePet(3);

        $pet = $pets->random(1)->all();
        $pet = $pet[0];

        $newName = 'Гриня';
        $payload = [
            'name' => $newName,
            'sex'=>'test'
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::UPDATE_PET, ['pet'=>$pet]), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['sex']);
    }

    /**
     * В запросе присутствует чужой client_id, это не влияет
     * @group pet
     * @group petUpdate
     */
    public function testClientId202()
    {
        $user = $this->currentUser();
        $pets = $this->generatePet(3);

        $pet = $pets->random(1)->all();
        $pet = $pet[0];
        $anotherUser = UserGenerator::generateClient();

        $payload = [
            'name' => 'Гриня',
            'client_id' => $anotherUser->client->id
        ];


        $response = $this->tokenHeader()->json('put', route(RouteNames::UPDATE_PET, ['pet'=>$pet]), $payload);


        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

        $this->assertDatabaseHas('pets', [
            'name' => 'Гриня',
            'client_id'=>$user->client->id
        ]);
    }

    /**
     * Клиент пытается обновить чужого питомца
     * @group pet
     * @group petUpdate
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

        $newName = 'Гриня';
        $payload = [
            'name' => $newName
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::UPDATE_PET, ['pet'=>$anotherPet]), $payload);

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }


    /**
     * Админ может обновить любого питомца
     * @group pet
     * @group petUpdate
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

        $newName = 'Гриня';
        $payload = [
            'name' => $newName
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::UPDATE_PET, ['pet'=>$anotherPet]), $payload);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

        $newPet = $this->getPetService()->findPet($anotherPet->id);
        $this->assertEquals($newPet->name, $newName);
    }

    /**
     * Питомец не найден
     * @group pet
     * @group petUpdate
     */
    public function testPetNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(2, [
            'client_id' => $anotherUser->client->id
        ]);

        $newName = 'Гриня';
        $payload = [
            'name' => $newName
        ];

        $response = $this->tokenHeader()->json('put', 'api/pets/1000');

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('pet.notFound')]);
    }
}