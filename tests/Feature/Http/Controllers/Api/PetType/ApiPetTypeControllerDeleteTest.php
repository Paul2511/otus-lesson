<?php


namespace Tests\Feature\Http\Controllers\Api\PetType;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\PetType;
use App\Models\Translate;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\PetTypeGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiPetTypeControllerDeleteTest extends TestCase
{
    use AuthAttach;

    /**
     * Админ успешно удаляет запись
     * @group petType
     * @group petTypeDelete
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $petTypes = PetTypeGenerator::generate(3);
        /** @var PetType $petType */
        $petType = $petTypes->random();
        /** @var Translate $translate */
        $translates = $petType->translates;

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_PET_TYPE, [
            'petType'=>$petType
        ]));

        $response->assertStatus(Controller::JSON_STATUS_OK);

        $this->assertDeleted($petType);

        $translates->each(function (Translate $translate) {
            $this->assertDeleted($translate);
        });
    }

    /**
     * Клиент не имеет права на удаление
     * @group petType
     * @group petTypeDelete
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $petTypes = PetTypeGenerator::generate(3);
        /** @var PetType $petType */
        $petType = $petTypes->random();

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_PET_TYPE, [
            'petType'=>$petType
        ]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Запись не найдена
     * @group petType
     * @group petTypeDelete
     */
    public function testPetTypeNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $fakePetType = PetType::factory()->makeOne([
            'id' => 1000
        ]);

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_PET_TYPE, [
            'petType'=>$fakePetType
        ]));

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('petType.notFound')]);
    }
}