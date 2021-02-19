<?php


namespace Tests\Generators;


use App\Models\Comment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Collection;

class CommentGenerator
{
    /**
     * @param array $data
     * @return Comment|Comment[]|Collection
     */
    private static function generate(?int $count = 1, ?array $data = [], ?bool $fake = false)
    {
        $comment = Comment::factory()->count($count);
        return $fake ? $comment->make($data) : $comment->create($data);
    }

    public static function generateByPet(?int $count = 1, ?array $data = [], ?bool $fake = false)
    {
        $pet = PetGenerator::generate(1)->first();

        return self::generate($count, array_merge([
            'type' => lcfirst(class_basename(Pet::class)),
            'row_id' => $pet->id
        ], $data), $fake);
    }

    public static function generateByUser(?int $count = 1, ?array $data = [], ?bool $fake = false)
    {
        if (!isset($data['row_id'])) {
            $user = UserGenerator::generateClient();
            $data['row_id'] = $user->id;
        }

        if (!isset($data['user_id'])) {
            $manager = UserGenerator::generateManager();
            $data['user_id'] = $manager->id;
        }

        return self::generate($count, array_merge([
            'type' => lcfirst(class_basename(User::class)),
        ], $data), $fake);
    }
}