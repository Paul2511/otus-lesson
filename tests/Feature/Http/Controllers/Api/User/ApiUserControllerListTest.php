<?php


namespace Tests\Feature\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\States\User\Role\AdminUserRole;
use App\States\User\Role\ClientUserRole;
use Tests\Generators\UserGenerator;
use App\Models\User;
use Tests\TestCase;

class ApiUserControllerListTest extends TestCase
{
    /**
     * Только админ имеет право на листинг
     * @group user
     * @group userList
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $anotherUsers = User::factory()->count(10)->create([
            'role' => ClientUserRole::class
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Только админ имеет право на листинг
     * @group user
     * @group userList
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUsers = User::factory()->count(10)->create([
            'role' => ClientUserRole::class
        ]);

        $usersCount = User::count();
        $count = $usersCount > Controller::RESULTS_PER_PAGE ? Controller::RESULTS_PER_PAGE : $usersCount;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * В запросе присутсвует per_page
     * @group user
     * @group userList
     */
    public function testPerPageSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUsers = User::factory()->count(10)->create([
            'role' => ClientUserRole::class
        ]);

        $count = 2;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
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
     * @group userList
     */
    public function testPerPageZeroWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUsers = User::factory()->count(10)->create([
            'role' => ClientUserRole::class
        ]);

        $count = 0;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
            'per_page'=>$count
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * per_page больше максимального
     * @group user
     * @group userList
     */
    public function testPerPageMaxSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUsers = User::factory()->count(9)->create([
            'role' => ClientUserRole::class
        ]);

        $requestCount = 200;

        $usersCount = User::count();
        $count = $usersCount > Controller::RESULTS_PER_PAGE ? Controller::RESULTS_PER_PAGE : $usersCount;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
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
     * @group userList
     */
    public function testPerPageWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);
        
        $anotherUsers = User::factory()->count(10)->create([
            'role' => ClientUserRole::class
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
            'per_page'=>'test'
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * В запросе присутсвует страница пагинации
     * @group user
     * @group userList
     */
    public function testPaginationSuccess200()
    {
        $countRecords = 12;
        $page = 2;

        $admin = $this->createUser(AdminUserRole::class);
        
        $anotherUsers = User::factory()->count($countRecords-1)->create([
            'role' => ClientUserRole::class
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
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
     * @group userList
     */
    public function testPaginationZeroSuccess200()
    {
        $countRecords = 13;
        $page = 0;

        $admin = $this->createUser(AdminUserRole::class);
        
        $anotherUsers = User::factory()->count($countRecords-1)->create([
            'role' => ClientUserRole::class
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
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
     * @group userList
     */
    public function testPaginationOverSuccess200()
    {
        $countRecords = 13;
        $page = 100;

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUsers = User::factory()->count($countRecords-1)->create([
            'role' => ClientUserRole::class
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
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
     * @group userList
     */
    public function testPaginationWrongSuccess200()
    {
        $countRecords = 13;
        $page = 'test';

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUsers = User::factory()->count($countRecords-1)->create([
            'role' => ClientUserRole::class
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
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
     * @group userList
     */
    public function testOrderSuccess200()
    {
        $countRecords = 3;

        $sortBy = 'email';
        $direction = 'desc';

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUsers = User::factory()->count($countRecords-1)->create([
            'role' => ClientUserRole::class
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
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

        $users = User::query()->orderBy($sortBy, $direction)->get()->map->{$sortBy};

        $this->assertEquals($responseOrder, $users);
    }

    /**
     * Сортировка по отсутствующему полю
     * @group user
     * @group userList
     */
    public function testOrderWrong422()
    {
        $countRecords = 3;

        $sortBy = 'test';
        $direction = 'desc';

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUsers = User::factory()->count($countRecords-1)->create([
            'role' => ClientUserRole::class
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['sort']);
    }

    /**
     * Направление сортировки неверное
     * @group user
     * @group userList
     */
    public function testOrderDirectionWrong422()
    {
        $countRecords = 3;
        $sortBy = 'name';
        $direction = 'test';

        $admin = $this->createUser(AdminUserRole::class);

        $anotherUsers = User::factory()->count($countRecords-1)->create([
            'role' => ClientUserRole::class
        ]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_ALL_USERS,[
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['direction']);
    }
}