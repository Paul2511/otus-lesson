<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiAuthControllerProfileTest extends TestCase
{
    use AuthAttach;


    /**
     * Клиент получает свои данные
     * @group user
     * @group auth
     * @group profile
     */
    public function testProfileSuccessfully200()
    {
        $user = $this->currentUser();
        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_PROFILE));

        $result = json_decode($response->getContent(), true);

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data']);

        $this->assertEquals($user->id, $result['data']['id']);
    }

    /**
     * Любой другой запрос bad request
     * @group user
     * @group auth
     * @group profile2
     */
    public function testProfileBadRequest400()
    {
        $user = $this->currentUser();
        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_PROFILE).'/2');

        $response->assertStatus(400)
            ->assertJsonFragment(['message'=>trans('exception.badRequest')]);

    }

}