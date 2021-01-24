<?php


namespace Tests\Feature\Http\Controllers\Api\Pet;

use App\Models\PetType;
use Database\Seeders\PetTypesTableSeeder;
use Illuminate\Support\Collection;
use Tests\AuthAttach;
use Tests\TestCase;
use App\Models\Pet;
use Tests\Generators\PetGenerator;
use App\Services\Pets\Repositories\PetRepository;
class TestPet extends TestCase
{
    use AuthAttach;

    private static $isSeed = false;

    /**
     * @param int|null $count
     * @param array|null $data
     * @return Pet|Pet[]|Collection
     */
    protected function generatePet(?int $count = 1, ?array $data = [])
    {
        if (!self::$isSeed || !PetType::count()) {
            $this->seed(PetTypesTableSeeder::class);
            self::$isSeed = true;
        }

        if (!count($data) || !isset($data['client_id'])) {
            $clientId = $this->currentUser()->client->id;
            $data = array_merge($data, [
                'client_id' => $clientId
            ]);
        }

        return PetGenerator::generate($count, $data);
    }
}