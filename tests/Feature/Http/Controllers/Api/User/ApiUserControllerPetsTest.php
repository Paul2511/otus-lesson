<?php


namespace Tests\Feature\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Pet;
use App\Models\User;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiUserControllerPetsTest extends TestCase
{
    use AuthAttach;

    /**
     * Клиент получает своих питомцев по такому запросу
     * @group user
     * @group pet
     * @group userPets
     */
    public function testClientSuccess200()
    {
        $user = $this->currentUser();

        $pets = $this->generatePet(10, [
            'client_id' => $user->client->id
        ]);

        $petsCount = Pet::count();
        $count = $petsCount > Controller::RESULTS_PER_PAGE ? Controller::RESULTS_PER_PAGE : $petsCount;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS, ['user'=>$user]));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * Клиент получает НЕ свои данные по такому запросу
     * @group user
     * @group pet
     * @group userPets
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);


        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS, ['user'=>$anotherUser]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ получает данные любого клиента
     * @group user
     * @group pet
     * @group userPets
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS, ['user'=>$anotherUser]));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data']);
    }

    /**
     * Пользователь не найден
     * @group user
     * @group pet
     * @group userPets
     */
    public function testUserNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $fakeUser = User::factory()->makeOne([
            'id' => 1000
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS, [
            'user' => $fakeUser
        ]));

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('user.notFound')]);
    }

    /**
     * В запросе присутсвует per_page
     * @group user
     * @group pet
     * @group userPets
     */
    public function testPerPageSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);

        $count = 2;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
            'per_page'=>$count
        ]));


        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }


    /**
     * per_page = 0
     * @group user
     * @group pet
     * @group userPets
     */
    public function testPerPageZeroWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);

        $count = 0;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
            'per_page'=>$count
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * per_page больше максимального
     * @group user
     * @group pet
     * @group userPets
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

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
            'per_page'=>$requestCount
        ]));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * per_page не число
     * @group user
     * @group pet
     * @group userPets
     */
    public function testPerPageWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $anotherPets = $this->generatePet(10, [
            'client_id' => $anotherUser->client->id
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
            'per_page'=>'test'
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * В запросе присутсвует страница пагинации
     * @group user
     * @group pet
     * @group userPets
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

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
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
     * @group user
     * @group pet
     * @group userPets
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

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
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
     * @group user
     * @group pet
     * @group userPets
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

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
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
     * @group user
     * @group pet
     * @group userPets
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

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
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
     * @group user
     * @group pet
     * @group userPets
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

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
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
     * @group user
     * @group pet
     * @group userPets
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

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['sort']);
    }

    /**
     * Направление сортировки неверное
     * @group user
     * @group pet
     * @group userPets
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

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_PETS,[
            'user'=>$anotherUser,
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['direction']);
    }


}