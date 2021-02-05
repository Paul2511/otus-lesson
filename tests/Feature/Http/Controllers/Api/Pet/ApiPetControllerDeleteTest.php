<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Jobs\Pet\PetDeleteJob;
use App\Models\Pet;
use App\States\User\Role\AdminUserRole;
use Illuminate\Support\Facades\Bus;
use Tests\Generators\UserGenerator;
use App\Models\User;
class ApiPetControllerDeleteTest extends TestPet
{
    /**
     * Клиент удаляет своего питомца
     * @group pet
     * @group petDelete
     */
    public function testClientSuccess200()
    {
        $user = $this->currentUser();

        $pets = $this->generatePet(3);

        $pet = $pets->random(1)->all();
        $pet = $pet[0];

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_PET, ['pet'=>$pet]));

        $response->assertStatus(Controller::JSON_STATUS_OK);

        $this->assertDeleted($pet);
    }

    /**
     * Клиент удаляет НЕ своего питомца
     * @group pet
     * @group petDelete
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();
        $myPets = $this->generatePet(5);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(3, [
            'client_id' => $anotherUser->client->id
        ]);

        $pet = $anotherPets->random(1)->all();
        $pet = $pet[0];

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_PET, ['pet'=>$pet]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ может удалить любого питомца
     * @group pet
     * @group petDelete
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(5, [
            'client_id' => $anotherUser->client->id
        ]);

        $pet = $anotherPets->random(1)->all();
        $pet = $pet[0];

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_PET, ['pet'=>$pet]));

        $response->assertStatus(Controller::JSON_STATUS_OK);


        $this->assertDeleted($pet);
    }

    /**
     * Питомец не найден
     * @group pet
     * @group petDelete
     */
    public function testPetNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);
        $fakePet = Pet::factory()->makeOne([
            'id' => 1000
        ]);

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_PET, [
            'pet' => $fakePet
        ]));

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('pet.notFound')]);
    }

    /**
     * Отсутствует питомец в запросе
     * @group pet
     * @group petDelete
     */
    public function testWithoutPet400()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('delete', '/api/v1/pets/');

        $response->assertStatus(400)
            ->assertJsonFragment(['message'=>trans('exception.badRequest')]);
    }

    /**
     * Клиент удаляет своего питомца, тест очереди
     * @group pet
     * @group petDelete
     * @group queue
     */
    public function testQueueSuccess()
    {
        Bus::fake();

        $user = $this->currentUser();

        $pets = $this->generatePet(3);

        $pet = $pets->random(1)->all();
        $pet = $pet[0];

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_PET, ['pet'=>$pet]));

        $response->assertStatus(Controller::JSON_STATUS_OK);

        Bus::assertDispatched(PetDeleteJob::class);

    }
}