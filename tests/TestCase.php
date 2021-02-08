<?php

namespace Tests;

use App\Models\PetType;
use App\Models\Specialization;
use Database\Seeders\PetTypesTableSeeder;
use Database\Seeders\SpecializationsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

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

}
