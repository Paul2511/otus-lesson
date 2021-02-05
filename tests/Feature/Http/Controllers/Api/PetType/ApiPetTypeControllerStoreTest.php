<?php


namespace Tests\Feature\Http\Controllers\Api\PetType;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\States\User\Role\AdminUserRole;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiPetTypeControllerStoreTest extends TestCase
{
    use AuthAttach;

    /**
     * Админ успешно создает запись
     * @group petType
     * @group petTypeStore
     */
    public function testAdminSuccess201()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $translate_1 = ['type' => 'petType', 'locale' => 'ru', 'value' => 'Тест'];
        $translate_2 = ['type' => 'petType', 'locale' => 'en', 'value' => 'Test'];

        $payload = [
            'slug' => 'test',
            'translates' => [$translate_1,$translate_2]
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_PET_TYPE), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED)
            ->assertJsonStructure(['data']);

        $this->assertDatabaseHas('pet_types', [
            'slug' => 'test'
        ]);

        $this->assertDatabaseHas('translates', $translate_1);
        $this->assertDatabaseHas('translates', $translate_2);
    }

    /**
     * Клиент не имеет права на создание
     * @group petType
     * @group petTypeStore
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $translate_1 = ['type' => 'petType', 'locale' => 'ru', 'value' => 'Тест'];
        $translate_2 = ['type' => 'petType', 'locale' => 'en', 'value' => 'Test'];

        $payload = [
            'slug' => 'test',
            'translates' => [$translate_1,$translate_2]
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_PET_TYPE), $payload);

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Требуются поля формы
     * @group petType
     * @group petTypeStore
     */
    public function testRequiresFields422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_PET_TYPE), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['slug']);
    }


    /**
     * Неверное поле translates
     * @group petType
     * @group petTypeStore
     */
    public function testTranslatesWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'slug' => 'test',
            'translates' => 'test'
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_PET_TYPE), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['translates']);

        $this->assertDatabaseMissing('pet_types', [
            'slug' => 'test'
        ]);
    }

    /**
     * Неверные поля внутри translates. В этом случае translates игнорируется, а запись создается
     * @group petType
     * @group petTypeStore
     */
    public function testTranslatesInWrong201()
    {
        $admin = $this->createUser(AdminUserRole::class);
        $translate_1 = ['test' => 'test'];

        $payload = [
            'slug' => 'test',
            'translates' => [$translate_1]
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_PET_TYPE), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED)
            ->assertJsonStructure(['data']);

        $this->assertDatabaseHas('pet_types', [
            'slug' => 'test'
        ]);

        $this->assertDatabaseCount('translates', 0);
    }

}