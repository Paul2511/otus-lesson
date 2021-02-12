<?php


namespace Tests\Feature\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Comment;
use App\Models\Specialization;
use App\Models\Translate;
use App\States\User\Role\AdminUserRole;
use App\States\User\Role\ManagerUserRole;
use Tests\Generators\CommentGenerator;
use Tests\Generators\SpecializationGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiCommentControllerDeleteTest extends TestCase
{
    use AuthAttach;

    /**
     * Админ успешно удаляет свою запись
     * @group comment
     * @group commentDelete
     */
    public function testAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $comments = CommentGenerator::generateByPet(3, ['user_id'=>$admin->loginUser->id]);
        /** @var Comment $comment */
        $comment = $comments->random();

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_COMMENT, [
            'comment'=>$comment
        ]));

        $response->assertStatus(Controller::JSON_STATUS_OK);

        $this->assertDeleted($comment);

    }

    /**
     * Клиент не имеет права на удаление
     * @group comment
     * @group commentDelete
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $comments = CommentGenerator::generateByPet(3, ['user_id'=>$user->id]);
        /** @var Comment $comment */
        $comment = $comments->random();

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_COMMENT, [
            'comment'=>$comment
        ]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Админ пытается удалить чужой коммент
     * @group comment
     * @group commentDelete
     */
    public function testAdminSomeoneDenied403()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $manager = UserGenerator::generateManager();
        $comments = CommentGenerator::generateByPet(3, ['user_id'=>$manager->id]);
        /** @var Comment $comment */
        $comment = $comments->random();

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_COMMENT, [
            'comment'=>$comment
        ]));

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Комментарий не найден
     * @group comment
     * @group commentDelete
     */
    public function testCommentNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $fakeComment = CommentGenerator::generateByPet(1, ['id'=>1000, 'user_id'=>$admin->loginUser->id], true);

        $response = $this->tokenHeader()->json('delete', route(RouteNames::V1_DELETE_COMMENT, [
            'comment'=>$fakeComment->first()
        ]));

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('comment.notFound')]);
    }
}