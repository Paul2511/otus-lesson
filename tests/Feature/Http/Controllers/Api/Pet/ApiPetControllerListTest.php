<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Pet;
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

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS));

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
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);


        $petsCount = Pet::count();
        $count = $petsCount > Controller::RESULTS_PER_PAGE ? Controller::RESULTS_PER_PAGE : $petsCount;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * В запросе присутсвует per_page
     * @group pet
     * @group petList
     */
    public function testPerPageSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);

        $count = 2;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'per_page'=>$count
        ]));


        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }


    /**
     * per_page = 0
     * @group pet
     * @group petList
     */
    public function testPerPageZeroWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);

        $count = 0;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'per_page'=>$count
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * per_page больше максимального
     * @group pet
     * @group petList
     */
    public function testPerPageMaxSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);

        $requestCount = 200;

        $petsCount = Pet::count();
        $count = $petsCount > Controller::RESULTS_PER_PAGE ? Controller::RESULTS_PER_PAGE : $petsCount;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'per_page'=>$requestCount
        ]));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * per_page не число
     * @group pet
     * @group petList
     */
    public function testPerPageWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'per_page'=>'test'
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * В запросе присутсвует страница пагинации
     * @group pet
     * @group petList
     */
    public function testPaginationSuccess200()
    {
        $countRecords = 12;
        $page = 2;

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet($countRecords, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'page'=>$page
        ]));

        $count = 2;

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * Пагинация = 0
     * @group pet
     * @group petList
     */
    public function testPaginationZeroSuccess200()
    {
        $countRecords = 13;
        $page = 0;

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet($countRecords, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'page'=>$page
        ]));

        $count = Controller::RESULTS_PER_PAGE;

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * Пагинация большая
     * @group pet
     * @group petList
     */
    public function testPaginationOverSuccess200()
    {
        $countRecords = 13;
        $page = 100;

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet($countRecords, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'page'=>$page
        ]));

        $count = 0;

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * Пагинация не число
     * @group pet
     * @group petList
     */
    public function testPaginationWrongSuccess200()
    {
        $countRecords = 13;
        $page = 'test';

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet($countRecords, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'page'=>$page
        ]));

        $count = Controller::RESULTS_PER_PAGE;

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * В запросе присутствует сортировка
     * @group pet
     * @group petList
     */
    public function testOrderSuccess200()
    {
        $countRecords = 3;

        $sortBy = 'name';
        $direction = 'desc';

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet($countRecords, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $count = $countRecords;

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');

        $result = json_decode($response->content(), true);
        $data = $result['data'];
        $responseOrder = collect($data)->map->{$sortBy};

        $pets = Pet::query()->orderBy($sortBy, $direction)->get()->map->{$sortBy};

        $this->assertEquals($responseOrder, $pets);
    }

    /**
     * Сортировка по отсутствующему полю
     * @group pet
     * @group petList
     */
    public function testOrderWrong422()
    {
        $countRecords = 3;

        $sortBy = 'test';
        $direction = 'desc';

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet($countRecords, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['sort']);
    }

    /**
     * Направление сортировки неверное
     * @group pet
     * @group petList
     */
    public function testOrderDirectionWrong422()
    {
        $countRecords = 3;
        $sortBy = 'name';
        $direction = 'test';

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet($countRecords, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_PETS,[
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['direction']);
    }
}