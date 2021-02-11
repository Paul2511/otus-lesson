<?php

namespace Tests;

use App\Models\Pet;
use App\Models\PetType;
use App\Models\Specialization;
use Database\Seeders\PetTypesTableSeeder;
use Database\Seeders\SpecializationsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestResponse;
use Tests\Generators\PetGenerator;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use AuthAttach;

    //Общая вспомогательная функция для отладки
    protected function ddResponse(TestResponse $response)
    {
        $content = $response->getContent();
        dd(json_decode($content, true));
    }

    protected function seedPetTypes() {
        if (!PetType::count()) {
            $this->seed(PetTypesTableSeeder::class);
        }
    }

    protected function seedSpecializations() {
        if (!Specialization::count()) {
            $this->seed(SpecializationsTableSeeder::class);
        }
    }

    /**
     * @param int|null $count
     * @param array|null $data
     * @return Pet|Pet[]|Collection
     */
    protected function generatePet(?int $count = 1, ?array $data = [])
    {
        $this->seedPetTypes();

        if (!count($data) || !isset($data['client_id'])) {
            $clientId = $this->currentUser()->client->id;
            $data = array_merge($data, [
                'client_id' => $clientId
            ]);
        }

        return PetGenerator::generate($count, $data);
    }
}
