<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
class ApiPetControllerIndexTest extends TestPet
{
    /**
     * Клиент получает листинг своих питомцев
     * @group pet
     * @group petIndex
     */
    public function testClientSuccess200()
    {
        $user = $this->currentUser();

        $pets = $this->generatePet(3);

        $response = $this->tokenHeader()->json('get', route(RouteNames::GET_PETS));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(3, 'data');
    }

    /**
     * У клиента нет питомцев
     * @group pet
     * @group petIndex
     */
    public function testClientNoPetsSuccess200()
    {
        $user = $this->currentUser();

        $response = $this->tokenHeader()->json('get', route(RouteNames::GET_PETS));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(0, 'data');
    }

}