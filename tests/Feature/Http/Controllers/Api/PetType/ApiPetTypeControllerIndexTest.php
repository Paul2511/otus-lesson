<?php


namespace Tests\Feature\Http\Controllers\Api\PetType;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\PetType;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\PetTypeGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiPetTypeControllerIndexTest extends TestCase
{
    use AuthAttach;

    /**
     * Клиент не имеет права на просмотр
     * @group petType
     * @group petTypeIndex
     */
    public function testClientDenied403()
    {
        $this->seedPetTypes();
        $user = $this->currentUser();

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ получает список с нужным каунтом и массивом meta
     * @group petType
     * @group petTypeIndex
     */
    public function testAdminSuccess200()
    {
        $this->seedPetTypes();
        $petTypesCount = PetType::count();

        $count = $petTypesCount > Controller::RESULTS_PER_PAGE ? Controller::RESULTS_PER_PAGE : $petTypesCount;

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * В запросе присутсвует per_page
     * @group petType
     * @group petTypeIndex
     */
    public function testPerPageSuccess200()
    {
        $this->seedPetTypes();
        $admin = $this->createUser(AdminUserRole::class);

        $count = 2;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
            'per_page'=>$count
        ]));


        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * per_page = 0
     * @group petType
     * @group petTypeIndex
     */
    public function testPerPageZeroWrong422()
    {
        $this->seedPetTypes();
        $admin = $this->createUser(AdminUserRole::class);

        $count = 0;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
            'per_page'=>$count
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * per_page больше максимального
     * @group petType
     * @group petTypeIndex
     */
    public function testPerPageMaxSuccess200()
    {
        $this->seedPetTypes();
        $petTypesCount = PetType::count();
        $admin = $this->createUser(AdminUserRole::class);

        $requestCount = 200;

        $count = $petTypesCount > Controller::RESULTS_PER_PAGE ? Controller::RESULTS_PER_PAGE : $petTypesCount;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
            'per_page'=>$requestCount
        ]));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * per_page не число
     * @group petType
     * @group petTypeIndex
     */
    public function testPerPageWrong422()
    {
        $this->seedPetTypes();
        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
            'per_page'=>'test'
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * В запросе присутсвует страница пагинации
     * @group petType
     * @group petTypeIndex
     */
    public function testPaginationSuccess200()
    {
        $countRecords = 12;
        $page = 2;

        PetTypeGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
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
     * @group petType
     * @group petTypeIndex
     */
    public function testPaginationZeroSuccess200()
    {
        $countRecords = 13;
        $page = 0;

        PetTypeGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
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
     * @group petType
     * @group petTypeIndex
     */
    public function testPaginationOverSuccess200()
    {
        $countRecords = 13;
        $page = 100;

        PetTypeGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
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
     * @group petType
     * @group petTypeIndex
     */
    public function testPaginationWrongSuccess200()
    {
        $countRecords = 13;
        $page = 'test';

        PetTypeGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
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
     * @group petType
     * @group petTypeIndex
     */
    public function testOrderSuccess200()
    {
        $countRecords = 3;

        $sortBy = 'slug';
        $direction = 'desc';

        PetTypeGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
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

        $petTypes = PetType::query()->orderBy($sortBy, $direction)->get()->map->{$sortBy};

        $this->assertEquals($responseOrder, $petTypes);
    }

    /**
     * Сортировка по отсутствующему полю
     * @group petType
     * @group petTypeIndex
     */
    public function testOrderWrong422()
    {
        $countRecords = 3;

        $sortBy = 'test';
        $direction = 'desc';

        PetTypeGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['sort']);
    }

    /**
     * Направление сортировки неверное
     * @group petType
     * @group petTypeIndex
     */
    public function testOrderDirectionWrong422()
    {
        $countRecords = 3;
        PetTypeGenerator::generate($countRecords);

        $sortBy = 'slug';
        $direction = 'test';

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_PET_TYPES,[
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['direction']);
    }
}