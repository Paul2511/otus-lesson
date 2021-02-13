<?php


namespace Tests\Generators;


use App\Models\Article;

class ArticleGenerate
{
    public static function article(array $data = [])
    {
        return self::generate(array_merge([
            'name' => 'Test article',
            'slug' => 'test-slug'
        ], $data));
    }

    private static function generate(array $data)
    {
        return Article::factory()->create($data);
    }

}
