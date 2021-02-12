<?php


namespace Tests\Feature\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Comment;
use App\Services\Comments\CommentService;
use App\States\User\Role\AdminUserRole;
use Tests\Generators\CommentGenerator;
use Faker\Generator;
use Tests\Generators\PetGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiCommentControllerUpdateTest extends TestCase
{
    use AuthAttach;

    private function getCommentService(): CommentService
    {
        return app(CommentService::class);
    }

    protected function getFaker():Generator
    {
        return app(Generator::class);
    }

    /**
     * Админ успешно обновляет запись
     * @group comment
     * @group commentUpdate
     */
    public function testAdminSuccess202()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $comments = CommentGenerator::generateByPet(3, ['user_id'=>$admin->loginUser->id]);
        /** @var Comment $comment */
        $comment = $comments->random();

        $newBody = $this->getFaker()->text;

        $payload = [
            'type' => $comment->type,
            'row_id' => $comment->row_id,
            'body' => $newBody
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_COMMENT, [
            'comment'=>$comment
        ]), $payload);

        $response->assertStatus(Controller::JSON_STATUS_ACCEPTED)
            ->assertJsonStructure(['data']);

        $newComment = $this->getCommentService()->findById($comment->id);
        $this->assertEquals($newComment->body, $newBody);
    }

    /**
     * Клиент не имеет права на update
     * @group comment
     * @group commentUpdate
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $user = $this->currentUser();

        $comments = CommentGenerator::generateByPet(3, ['user_id'=>$user->id]);
        /** @var Comment $comment */
        $comment = $comments->random();

        $newBody = $this->getFaker()->text;

        $payload = [
            'type' => $comment->type,
            'row_id' => $comment->row_id,
            'body' => $newBody
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_COMMENT, [
            'comment'=>$comment
        ]), $payload);


        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }


    /**
     * Админ пытается изменить чужой коммент
     * @group comment
     * @group commentUpdate
     */
    public function testAdminSomeoneDenied403()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $manager = UserGenerator::generateManager();
        $comments = CommentGenerator::generateByPet(3, ['user_id'=>$manager->id]);
        /** @var Comment $comment */
        $comment = $comments->random();

        $newBody = $this->getFaker()->text;

        $payload = [
            'type' => $comment->type,
            'row_id' => $comment->row_id,
            'body' => $newBody
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_COMMENT, [
            'comment'=>$comment
        ]), $payload);


        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Комментарий не найден
     * @group comment
     * @group commentUpdate
     */
    public function testCommentNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $fakeComment = CommentGenerator::generateByPet(1, ['id'=>1000, 'user_id'=>$admin->loginUser->id], true);
        $fakeComment = $fakeComment->first();

        $newBody = $this->getFaker()->text;

        $payload = [
            'type' => $fakeComment->type,
            'row_id' => $fakeComment->row_id,
            'body' => $newBody
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_COMMENT, [
            'comment'=>$fakeComment
        ]), $payload);

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('comment.notFound')]);
    }


    /**
     * Требуются поля формы
     * @group comment
     * @group commentUpdate
     */
    public function testRequiresFields422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $comments = CommentGenerator::generateByPet(3, ['user_id'=>$admin->loginUser->id]);
        /** @var Comment $comment */
        $comment = $comments->random();

        $payload = [];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_COMMENT, [
            'comment'=>$comment
        ]), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['type', 'row_id', 'body']);
    }

    /**
     * Неверное поле row_id
     * @group comment
     * @group commentUpdate
     */
    public function testRowWrong422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $comments = CommentGenerator::generateByPet(3, ['user_id'=>$admin->loginUser->id]);
        /** @var Comment $comment */
        $comment = $comments->random();

        $newBody = $this->getFaker()->text;

        $payload = [
            'type' => $comment->type,
            'row_id' => 'test',
            'body' => $newBody
        ];

        $response = $this->tokenHeader()->json('put', route(RouteNames::V1_UPDATE_COMMENT, [
            'comment'=>$comment
        ]), $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['row_id']);
    }
}