<?php


namespace Tests\Generators;

use App\Models\Pet;
use Illuminate\Support\Collection;

class PetGenerator
{
    /**
     * @param int|null $count
     * @param array|null $data
     * @return Pet|Pet[]|Collection
     */
    public static function generate(?int $count = 1, ?array $data = [])
    {
        $pets = Pet::factory()
            ->count($count)
            ->create($data);

        return $pets;
    }
}