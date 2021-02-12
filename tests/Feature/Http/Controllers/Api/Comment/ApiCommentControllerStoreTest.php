<?php


namespace Tests\Feature\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\States\User\Role\AdminUserRole;
use Faker\Generator;
use Tests\Generators\PetGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiCommentControllerStoreTest extends TestCase
{
    use AuthAttach;

    protected function getFaker():Generator
    {
        return app(Generator::class);
    }

    /**
     * Админ успешно создает запись
     * @group comment
     * @group commentStore
     */
    public function testAdminSuccess201()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $pet = PetGenerator::generate(1)->first();

        $bodyText = $this->getFaker()->text;

        $payload = [
            'type' => 'pet',
            'row_id' => $pet->id,
            'body' => $bodyText
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_COMMENT), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED)
            ->assertJsonStructure(['data']);

        $this->assertDatabaseHas('comments', $payload);
    }

    /**
     * Клиент не имеет права на создание
     * @group comment
     * @group commentStore
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $pet = PetGenerator::generate(1)->first();

        $bodyText = $this->getFaker()->text;

        $payload = [
            'type' => 'pet',
            'row_id' => $pet->id,
            'body' => $bodyText,
            'user_id' => $user->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_COMMENT), $payload);

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Требуются поля формы
     * @group comment
     * @group commentStore
     */
    public function testRequiresFields422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_COMMENT), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['type', 'row_id', 'body']);
    }


    /**
     * Неверное поле row_id
     * @group comment
     * @group commentStore
     */
    public function testRowWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $bodyText = $this->getFaker()->text;

        $payload = [
            'type' => 'pet',
            'row_id' => 'test',
            'body' => $bodyText
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_COMMENT), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['row_id']);
    }
}