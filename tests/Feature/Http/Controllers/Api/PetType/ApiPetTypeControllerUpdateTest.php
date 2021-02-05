<?php


namespace Tests\Feature\Http\Controllers\Api\PetType;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\PetType;
use App\Models\Translate;
use App\Services\PetTypes\PetTypeService;
use App\Services\Translates\TranslateService;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\PetTypeGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiPetTypeControllerUpdateTest extends TestCase
{
    use AuthAttach;

    private function getPetTypeService(): PetTypeService
    {
        return app(PetTypeService::class);
    }

    private function getTranslateService():TranslateService
    {
        return app(TranslateService::class);
    }

    /**
     * Админ успешно обновляет запись
     * @group petType
     * @group petTypeUpdate
     */
    public function testAdminSuccess202()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $petTypes = PetTypeGenerator::generate(3);
        /** @var PetType $petType */
        $petType = $petTypes->random();
        /** @var Translate $translate */
        $translate = $petType->translates->take(1)->first();

        $newSlug = 'test_123';
        $newValue = 'Тест_123';

        $translate_1 = ['id'=>$translate->id, 'type' => $translate->type, 'locale' => $translate->locale, 'value' => $newValue];

        $payload = [
            'slug' => $newSlug,
            'translates' => [$translate_1]
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_PET_TYPE, [
            'petType'=>$petType
        ]), $payload);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

        $newPetType = $this->getPetTypeService()->findById($petType->id);
        $this->assertEquals($newPetType->slug, $newSlug);

        $newTranslate = $this->getTranslateService()->findById($translate->id);
        $this->assertEquals($newTranslate->value, $newValue);
    }

    /**
     * Клиент не имеет права на update
     * @group petType
     * @group petTypeUpdate
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $petTypes = PetTypeGenerator::generate(3);
        /** @var PetType $petType */
        $petType = $petTypes->random();
        /** @var Translate $translate */
        $translate = $petType->translates->take(1)->first();

        $newSlug = 'test_123';
        $newValue = 'Тест_123';

        $translate_1 = ['id'=>$translate->id, 'type' => $translate->type, 'locale' => $translate->locale, 'value' => $newValue];

        $payload = [
            'slug' => $newSlug,
            'translates' => [$translate_1]
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_PET_TYPE, [
            'petType'=>$petType
        ]), $payload);


        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Запись не найдена
     * @group petType
     * @group petTypeUpdate
     */
    public function testPetTypeNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $fakePetType = PetType::factory()->makeOne([
            'id' => 1000
        ]);

        $newSlug = 'test_123';

        $payload = [
            'slug' => $newSlug
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_PET_TYPE, [
            'petType'=>$fakePetType
        ]), $payload);

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('petType.notFound')]);
    }


    /**
     * Неверное поле translates
     * @group petType
     * @group petTypeUpdate
     */
    public function testTranslatesWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $petTypes = PetTypeGenerator::generate(3);
        /** @var PetType $petType */
        $petType = $petTypes->random();

        $oldSlug = $petType->slug;
        $newSlug = 'test_123';

        $payload = [
            'slug' => $newSlug,
            'translates' => 'test'
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_PET_TYPE, [
            'petType'=>$petType
        ]), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['translates']);

        $newPetType = $this->getPetTypeService()->findById($petType->id);
        $this->assertEquals($newPetType->slug, $oldSlug);
    }

    /**
     * translate передается без id, поле игнорируется
     * @group petType
     * @group petTypeUpdate
     */
    public function testTranslateWithoutIdWrong()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $petTypes = PetTypeGenerator::generate(3);
        /** @var PetType $petType */
        $petType = $petTypes->random();
        /** @var Translate $translate */
        $translate = $petType->translates->take(1)->first();

        $newSlug = 'test_123';
        $oldValue = $translate->value;
        $newValue = 'Тест_123';

        $translate_1 = ['type' => $translate->type, 'locale' => $translate->locale, 'value' => $newValue];

        $payload = [
            'slug' => $newSlug,
            'translates' => [$translate_1]
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_PET_TYPE, [
            'petType'=>$petType
        ]), $payload);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

        $newPetType = $this->getPetTypeService()->findById($petType->id);
        $this->assertEquals($newPetType->slug, $newSlug);

        $newTranslate = $this->getTranslateService()->findById($translate->id);
        $this->assertEquals($newTranslate->value, $oldValue);
    }
}