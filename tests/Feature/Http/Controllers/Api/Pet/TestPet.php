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

}