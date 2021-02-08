<?php


namespace Tests\Feature\Http\Controllers\Api\Specialization;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Specialization;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\SpecializationGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiSpecializationControllerIndexTest extends TestCase
{
    use AuthAttach;

    /**
     * Клиент не имеет права на просмотр
     * @group specialization
     * @group specializationIndex
     */
    public function testClientDenied403()
    {
        $this->seedSpecializations();
        $user = $this->currentUser();

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ получает список с нужным каунтом и массивом meta
     * @group specialization
     * @group specializationIndex
     */
    public function testAdminSuccess200()
    {
        $this->seedSpecializations();
        $specializationsCount = Specialization::count();

        $count = $specializationsCount > Controller::RESULTS_PER_PAGE ? Controller::RESULTS_PER_PAGE : $specializationsCount;

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * В запросе присутсвует per_page
     * @group specialization
     * @group specializationIndex
     */
    public function testPerPageSuccess200()
    {
        $this->seedSpecializations();
        $admin = $this->createUser(AdminUserRole::class);

        $count = 2;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
            'per_page'=>$count
        ]));


        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * per_page = 0
     * @group specialization
     * @group specializationIndex
     */
    public function testPerPageZeroWrong422()
    {
        $this->seedSpecializations();
        $admin = $this->createUser(AdminUserRole::class);

        $count = 0;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
            'per_page'=>$count
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * per_page больше максимального
     * @group specialization
     * @group specializationIndex
     */
    public function testPerPageMaxSuccess200()
    {
        $this->seedSpecializations();
        $specializationsCount = Specialization::count();
        $admin = $this->createUser(AdminUserRole::class);

        $requestCount = 200;

        $count = $specializationsCount > Controller::RESULTS_PER_PAGE ? Controller::RESULTS_PER_PAGE : $specializationsCount;

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
            'per_page'=>$requestCount
        ]));

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonStructure(['meta'])
            ->assertJsonCount($count, 'data');
    }

    /**
     * per_page не число
     * @group specialization
     * @group specializationIndex
     */
    public function testPerPageWrong422()
    {
        $this->seedSpecializations();
        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
            'per_page'=>'test'
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    /**
     * В запросе присутсвует страница пагинации
     * @group specialization
     * @group specializationIndex
     */
    public function testPaginationSuccess200()
    {
        $countRecords = 12;
        $page = 2;

        SpecializationGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
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
     * @group specialization
     * @group specializationIndex
     */
    public function testPaginationZeroSuccess200()
    {
        $countRecords = 13;
        $page = 0;

        SpecializationGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
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
     * @group specialization
     * @group specializationIndex
     */
    public function testPaginationOverSuccess200()
    {
        $countRecords = 13;
        $page = 100;

        SpecializationGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
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
     * @group specialization
     * @group specializationIndex
     */
    public function testPaginationWrongSuccess200()
    {
        $countRecords = 13;
        $page = 'test';

        SpecializationGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
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
     * @group specialization
     * @group specializationIndex
     */
    public function testOrderSuccess200()
    {
        $countRecords = 3;

        $sortBy = 'slug';
        $direction = 'desc';

        SpecializationGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
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

        $specializations = Specialization::query()->orderBy($sortBy, $direction)->get()->map->{$sortBy};

        $this->assertEquals($responseOrder, $specializations);
    }

    /**
     * Сортировка по отсутствующему полю
     * @group specialization
     * @group specializationIndex
     */
    public function testOrderWrong422()
    {
        $countRecords = 3;

        $sortBy = 'test';
        $direction = 'desc';

        SpecializationGenerator::generate($countRecords);

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['sort']);
    }

    /**
     * Направление сортировки неверное
     * @group specialization
     * @group specializationIndex
     */
    public function testOrderDirectionWrong422()
    {
        $countRecords = 3;
        SpecializationGenerator::generate($countRecords);

        $sortBy = 'slug';
        $direction = 'test';

        $admin = $this->createUser(AdminUserRole::class);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_SPECIALIZATIONS,[
            'sort' => $sortBy,
            'direction' => $direction
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['direction']);
    }
}