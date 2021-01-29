<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\PetType;
use App\States\User\Role\ClientUserRole;
use Tests\Generators\UserGenerator;

class ApiPetControllerStoreTest extends TestPet
{
    /**
     * Клиент успешно создает питомца
     * @group pet
     * @group petStore
     */
    public function testClientSuccess201()
    {
        $user = $this->currentUser();
        $this->seedPetTypes();
        /** @var PetType $petType */
        $petType = PetType::orderByRaw('RAND()')->take(1)->first();

        $payload = [
            'name' => 'Гриня',
            'sex' => 'male',
            'pet_type_id'=>$petType->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::CREATE_PET), $payload);


        $response->assertStatus(Controller::JSON_STATUS_CREATED)
            ->assertJsonStructure(['data']);

        $this->assertDatabaseHas('pets', [
            'name' => 'Гриня',
            'sex' => 'male',
            'pet_type_id'=>$petType->id,
            'client_id'=>$user->client->id
        ]);

    }

    /**
     * Требуются поля формы
     * @group pet
     * @group petStore
     */
    public function testRequiresFields422()
    {
        $user = $this->currentUser();
        $this->seedPetTypes();
        /** @var PetType $petType */
        $petType = PetType::orderByRaw('RAND()')->take(1)->first();

        $payload = [];

        $response = $this->tokenHeader()->json('post', route(RouteNames::CREATE_PET), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name','sex','pet_type_id']);
    }

    /**
     * pet_type должно присутствовать в базе
     * @group pet
     * @group petStore
     */
    public function testWrongPetType422()
    {
        $user = $this->currentUser();
        $this->seedPetTypes();
        /** @var PetType $petType */
        $petType = PetType::orderByRaw('RAND()')->take(1)->first();

        $payload = [
            'name' => 'Гриня',
            'sex' => 'male',
            'pet_type_id'=>1000
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::CREATE_PET), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['pet_type_id']);
    }

    /**
     * Неверное поле sex
     * @group pet
     * @group petStore
     */
    public function testWrongSex422()
    {
        $user = $this->currentUser();
        $this->seedPetTypes();
        /** @var PetType $petType */
        $petType = PetType::orderByRaw('RAND()')->take(1)->first();

        $payload = [
            'name' => 'Гриня',
            'sex' => 'test',
            'pet_type_id'=>1000
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::CREATE_PET), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['sex']);
    }

    /**
     * В запросе присутствует чужой client_id - создает под своим
     * @group pet
     * @group petStore
     */
    public function testClientId201()
    {
        $user = $this->currentUser();
        $anotherUser = UserGenerator::generateClient();

        $this->seedPetTypes();
        /** @var PetType $petType */
        $petType = PetType::orderByRaw('RAND()')->take(1)->first();

        $payload = [
            'name' => 'Гриня',
            'sex' => 'male',
            'pet_type_id'=>$petType->id,
            'client_id' => $anotherUser->client->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::CREATE_PET), $payload);


        $response->assertStatus(Controller::JSON_STATUS_CREATED)
            ->assertJsonStructure(['data']);

        $this->assertDatabaseHas('pets', [
            'name' => 'Гриня',
            'sex' => 'male',
            'pet_type_id'=>$petType->id,
            'client_id'=>$user->client->id
        ]);
    }
}