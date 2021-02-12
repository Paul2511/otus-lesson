<?php


namespace Tests\Generators;


use App\Models\Comment;
use App\Models\Pet;
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
}