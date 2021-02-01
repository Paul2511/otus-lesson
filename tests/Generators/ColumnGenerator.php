<?php


namespace Tests\Generators;


use App\Models\Column;

class ColumnGenerator
{
    public static function generateTestColumn(array $data = [])
    {
        return self::generate(array_merge([
            'title' => 'test'
        ], $data));
    }

    private static function generate(array $data)
    {
        return Column::factory()->create($data);
    }

}
