<?php


namespace Tests\Feature\Http\Controllers\Api\Specialization;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Specialization;
use App\Models\Translate;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\SpecializationGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiSpecializationControllerDeleteTest extends TestCase
{
    use AuthAttach;

    /**
     * Админ успешно удаляет запись
     * @group specialization
     * @group specializationDelete
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $specializations = SpecializationGenerator::generate(3);

        /** @var Specialization $specialization */
        $specialization = $specializations->random();
        /** @var Translate $translate */
        $translates = $specialization->translates;

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_SPECIALIZATION, [
            'specialization'=>$specialization
        ]));

        $response->assertStatus(Controller::JSON_STATUS_OK);

        $this->assertDeleted($specialization);

        $translates->each(function (Translate $translate) {
            $this->assertDeleted($translate);
        });
    }

    /**
     * Клиент не имеет права на удаление
     * @group specialization
     * @group specializationDelete
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $specializations = SpecializationGenerator::generate(3);
        /** @var Specialization $specialization */
        $specialization = $specializations->random();

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_SPECIALIZATION, [
            'specialization'=>$specialization
        ]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Запись не найдена
     * @group specialization
     * @group specializationDelete
     */
    public function testSpecializationNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $fakeSpecialization = Specialization::factory()->makeOne([
            'id' => 1000
        ]);

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_SPECIALIZATION, [
            'specialization'=>$fakeSpecialization
        ]));

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('specialization.notFound')]);
    }
}