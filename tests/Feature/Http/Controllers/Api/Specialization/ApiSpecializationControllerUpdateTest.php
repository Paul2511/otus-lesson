<?php


namespace Tests\Feature\Http\Controllers\Api\Specialization;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Specialization;
use App\Models\Translate;
use App\Services\Specializations\SpecializationService;
use App\Services\Translates\TranslateService;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\SpecializationGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiSpecializationControllerUpdateTest extends TestCase
{
    use AuthAttach;

    private function getSpecializationService(): SpecializationService
    {
        return app(SpecializationService::class);
    }

    private function getTranslateService():TranslateService
    {
        return app(TranslateService::class);
    }

    /**
     * Админ успешно обновляет запись
     * @group specialization
     * @group specializationUpdate
     */
    public function testAdminSuccess202()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $specializations = SpecializationGenerator::generate(3);
        /** @var Specialization $specialization */
        $specialization = $specializations->random();
        /** @var Translate $translate */
        $translate = $specialization->translates->take(1)->first();

        $newSlug = 'test_123';
        $newValue = 'Тест_123';

        $translate_1 = ['id'=>$translate->id, 'type' => $translate->type, 'locale' => $translate->locale, 'value' => $newValue];

        $payload = [
            'slug' => $newSlug,
            'translates' => [$translate_1]
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_SPECIALIZATION, [
            'specialization'=>$specialization
        ]), $payload);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

        $newSpecialization = $this->getSpecializationService()->findById($specialization->id);
        $this->assertEquals($newSpecialization->slug, $newSlug);

        $newTranslate = $this->getTranslateService()->findById($translate->id);
        $this->assertEquals($newTranslate->value, $newValue);
    }

    /**
     * Клиент не имеет права на update
     * @group specialization
     * @group specializationUpdate
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $specializations = SpecializationGenerator::generate(3);
        /** @var Specialization $specialization */
        $specialization = $specializations->random();
        /** @var Translate $translate */
        $translate = $specialization->translates->take(1)->first();

        $newSlug = 'test_123';
        $newValue = 'Тест_123';

        $translate_1 = ['id'=>$translate->id, 'type' => $translate->type, 'locale' => $translate->locale, 'value' => $newValue];

        $payload = [
            'slug' => $newSlug,
            'translates' => [$translate_1]
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_SPECIALIZATION, [
            'specialization'=>$specialization
        ]), $payload);


        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Запись не найдена
     * @group specialization
     * @group specializationUpdate
     */
    public function testSpecializationNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $fakeSpecialization = Specialization::factory()->makeOne([
            'id' => 1000
        ]);

        $newSlug = 'test_123';

        $payload = [
            'slug' => $newSlug
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_SPECIALIZATION, [
            'specialization'=>$fakeSpecialization
        ]), $payload);

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('specialization.notFound')]);
    }


    /**
     * Неверное поле translates
     * @group specialization
     * @group specializationUpdate
     */
    public function testTranslatesWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $specializations = SpecializationGenerator::generate(3);
        /** @var Specialization $specialization */
        $specialization = $specializations->random();

        $oldSlug = $specialization->slug;
        $newSlug = 'test_123';

        $payload = [
            'slug' => $newSlug,
            'translates' => 'test'
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_SPECIALIZATION, [
            'specialization'=>$specialization
        ]), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['translates']);

        $newSpecialization = $this->getSpecializationService()->findById($specialization->id);
        $this->assertEquals($newSpecialization->slug, $oldSlug);
    }

    /**
     * translate передается без id, поле игнорируется
     * @group specialization
     * @group specializationUpdate
     */
    public function testTranslateWithoutIdWrong()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $specializations = SpecializationGenerator::generate(3);
        /** @var Specialization $specialization */
        $specialization = $specializations->random();
        /** @var Translate $translate */
        $translate = $specialization->translates->take(1)->first();

        $newSlug = 'test_123';
        $oldValue = $translate->value;
        $newValue = 'Тест_123';

        $translate_1 = ['type' => $translate->type, 'locale' => $translate->locale, 'value' => $newValue];

        $payload = [
            'slug' => $newSlug,
            'translates' => [$translate_1]
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_SPECIALIZATION, [
            'specialization'=>$specialization
        ]), $payload);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

        $newSpecialization = $this->getSpecializationService()->findById($specialization->id);
        $this->assertEquals($newSpecialization->slug, $newSlug);

        $newTranslate = $this->getTranslateService()->findById($translate->id);
        $this->assertEquals($newTranslate->value, $oldValue);
    }
}