<?php


namespace Tests\Feature\Http\Controllers\Api\Specialization;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\States\User\Role\AdminUserRole;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiSpecializationControllerStoreTest extends TestCase
{
    use AuthAttach;

    /**
     * Админ успешно создает запись
     * @group specialization
     * @group specializationStore
     */
    public function testAdminSuccess201()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $translate_1 = ['type' => 'specialization', 'locale' => 'ru', 'value' => 'Тест'];
        $translate_2 = ['type' => 'specialization', 'locale' => 'en', 'value' => 'Test'];

        $payload = [
            'slug' => 'test',
            'translates' => [$translate_1,$translate_2]
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_SPECIALIZATION), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED)
            ->assertJsonStructure(['data']);

        $this->assertDatabaseHas('specializations', [
            'slug' => 'test'
        ]);

        $this->assertDatabaseHas('translates', $translate_1);
        $this->assertDatabaseHas('translates', $translate_2);
    }

    /**
     * Клиент не имеет права на создание
     * @group specialization
     * @group specializationStore
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $translate_1 = ['type' => 'specialization', 'locale' => 'ru', 'value' => 'Тест'];
        $translate_2 = ['type' => 'specialization', 'locale' => 'en', 'value' => 'Test'];

        $payload = [
            'slug' => 'test',
            'translates' => [$translate_1,$translate_2]
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_SPECIALIZATION), $payload);

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Требуются поля формы
     * @group specialization
     * @group specializationStore
     */
    public function testRequiresFields422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_SPECIALIZATION), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['slug']);
    }


    /**
     * Неверное поле translates
     * @group specialization
     * @group specializationStore
     */
    public function testTranslatesWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'slug' => 'test',
            'translates' => 'test'
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_SPECIALIZATION), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['translates']);

        $this->assertDatabaseMissing('specializations', [
            'slug' => 'test'
        ]);
    }

    /**
     * Неверные поля внутри translates. В этом случае translates игнорируется, а запись создается
     * @group specialization
     * @group specializationStore
     */
    public function testTranslatesInWrong201()
    {
        $admin = $this->createUser(AdminUserRole::class);
        $translate_1 = ['test' => 'test'];

        $payload = [
            'slug' => 'test',
            'translates' => [$translate_1]
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_SPECIALIZATION), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED)
            ->assertJsonStructure(['data']);

        $this->assertDatabaseHas('specializations', [
            'slug' => 'test'
        ]);

        $this->assertDatabaseCount('translates', 0);
    }

}