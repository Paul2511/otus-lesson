<?php


namespace Tests\Feature\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\States\User\Role\AdminUserRole;
use App\States\User\Role\ClientUserRole;
use Tests\Generators\CommentGenerator;
use Tests\Generators\UserGenerator;
use App\Models\User;
use Tests\TestCase;

class ApiUserControllerCommentsTest extends TestCase
{
    /**
     * Клиент не имеет право
     * @group user
     * @group userComments
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();
        $anotherUser = UserGenerator::generateClient();
        $comments = CommentGenerator::generateByUser(3, ['row_id'=>$anotherUser->id]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_COMMENTS, [
            'user'=>$anotherUser
        ]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Только админ имеет право
     * @group user
     * @group userComments
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();
        $count = 3;
        $comments = CommentGenerator::generateByUser($count, ['row_id'=>$anotherUser->id]);

        $response = $this->tokenHeader()->json('get', route(RouteNames::V1_GET_USER_COMMENTS, [
            'user'=>$anotherUser
        ]));


        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonCount($count, 'data');
    }
}