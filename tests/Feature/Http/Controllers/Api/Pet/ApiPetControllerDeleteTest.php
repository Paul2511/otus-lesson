<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\Jobs\Pet\PetDeleteJob;
use Illuminate\Support\Facades\Bus;
use Tests\Generators\UserGenerator;
use App\Models\User;
class ApiPetControllerDeleteTest extends TestPet
{
    private static $uri = 'api/pets/';

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

        $response = $this->tokenHeader()->json('delete', self::$uri . $pet->id);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

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
            'client_id' => $anotherUser->id
        ]);

        $pet = $anotherPets->random(1)->all();
        $pet = $pet[0];

        $response = $this->tokenHeader()->json('delete', self::$uri . $pet->id);

        $response->assertStatus(403)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ может удалить любого питомца
     * @group pet
     * @group petDelete
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(5, [
            'client_id' => $anotherUser->id
        ]);

        $pet = $anotherPets->random(1)->all();
        $pet = $pet[0];

        $response = $this->tokenHeader()->json('delete', self::$uri . $pet->id);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDeleted($pet);
    }

    /**
     * Питомец не найден
     * @group pet
     * @group petDelete
     */
    public function testPetNotFound404()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $response = $this->tokenHeader()->json('delete', self::$uri . '12');

        $response->assertStatus(404)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('pet.notFound')]);
    }

    /**
     * Отсутствует питомец в запросе
     * @group pet
     * @group petDelete
     */
    public function testWithoutPet404()
    {
        $admin = $this->createUser(User::ROLE_ADMIN);

        $response = $this->tokenHeader()->json('delete', self::$uri);

        $response->assertStatus(404)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('main.urlNotFound')]);
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

        $response = $this->tokenHeader()->json('delete', self::$uri . $pet->id);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        Bus::assertDispatched(PetDeleteJob::class);

    }
}