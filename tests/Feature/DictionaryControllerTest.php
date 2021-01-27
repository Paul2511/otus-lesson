<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\Dictionaries\Providers\Routes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Generators\DictionaryGenerator;
use Tests\TestCase;
use Illuminate\Support\Facades\App;

class DictionaryControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testIndex()
    {
        $user = User::factory()->create();

        $dictionaryGenerator = App::make(DictionaryGenerator::class);
        $dictionaryGenerator->generateDictionaryWithRelations($user);

        $response = $this->actingAs($user)
            ->get(route(Routes::DICTIONARIES_INDEX));

        // TODO: Как проверить наличие словарей в ответе?

        $response->assertStatus(200);
    }

    public function testIndexNotAuthorized()
    {
        $response = $this->get(route(Routes::DICTIONARIES_INDEX));

        $response->assertRedirect(route('login'));
    }

    public function testShow()
    {
        $user = User::factory()->create();

        $dictionaryGenerator = App::make(DictionaryGenerator::class);
        $dictionary = $dictionaryGenerator->generateDictionaryWithRelations($user);

        $this->assertDatabaseCount('dictionaries', $dictionaryGenerator->getTotalDictionariesCount())
            ->assertDatabaseCount('words', $dictionaryGenerator->getTotalWordsCount())
            ->assertDatabaseCount('contexts', $dictionaryGenerator->getTotalContextsCount());

        $id = $dictionary->id;

        $response = $this->actingAs($user)
            ->get(route(Routes::DICTIONARIES_SHOW, [$id]));

        $response->assertStatus(200);
    }

    public function testShowSomeoneElse()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $dictionaryGenerator = App::make(DictionaryGenerator::class);
        $dictionary = $dictionaryGenerator->generateDictionaryWithRelations($user1);

        $this->assertDatabaseCount('dictionaries', $dictionaryGenerator->getTotalDictionariesCount())
            ->assertDatabaseCount('words', $dictionaryGenerator->getTotalWordsCount())
            ->assertDatabaseCount('contexts', $dictionaryGenerator->getTotalContextsCount());

        $id = $dictionary->id;

        $response = $this->actingAs($user2)
            ->get(route(Routes::DICTIONARIES_SHOW, [$id]));

        $response->assertStatus(403);
    }

    public function testShowNotAuthorized()
    {
        $user = User::factory()->create();

        $dictionaryGenerator = App::make(DictionaryGenerator::class);
        $dictionary = $dictionaryGenerator->generateDictionaryWithRelations($user);

        $this->assertDatabaseCount('dictionaries', $dictionaryGenerator->getTotalDictionariesCount())
            ->assertDatabaseCount('words', $dictionaryGenerator->getTotalWordsCount())
            ->assertDatabaseCount('contexts', $dictionaryGenerator->getTotalContextsCount());

        $id = $dictionary->id;

        $response = $this->get(route(Routes::DICTIONARIES_SHOW, [$id]));

        $response->assertRedirect(route('login'));
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $name = $this->faker->word();

        $response = $this->actingAs($user)
            ->post(route(Routes::DICTIONARIES_STORE), [
                'name' => $name,
            ]);

        $this->assertDatabaseCount('dictionaries', 1);

        $this->assertDatabaseHas('dictionaries', [
            'name' => $name,
        ]);

        $response->assertRedirect(route(Routes::DICTIONARIES_INDEX));
    }

    public function testStoreWithNoName()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route(Routes::DICTIONARIES_STORE));

        $this->assertDatabaseCount('dictionaries', 0);

        $response->assertStatus(400);
    }

    public function testStoreNotAuthorized()
    {
        $user = User::factory()->create();
        $name = $this->faker->word();

        $response = $this->actingAs($user)
            ->post(route(Routes::DICTIONARIES_STORE), [
                'name' => $name,
            ]);

        $this->assertDatabaseCount('dictionaries', 1);

        $this->assertDatabaseHas('dictionaries', [
            'name' => $name,
        ]);

        $response->assertRedirect(route(Routes::DICTIONARIES_INDEX));
    }

    public function testDestroy()
    {
        $user = User::factory()->create();

        $dictionaryGenerator = App::make(DictionaryGenerator::class);
        $dictionary = $dictionaryGenerator->generateDictionaryWithRelations($user);

        $this->assertDatabaseCount('dictionaries', $dictionaryGenerator->getTotalDictionariesCount())
            ->assertDatabaseCount('words', $dictionaryGenerator->getTotalWordsCount())
            ->assertDatabaseCount('contexts', $dictionaryGenerator->getTotalContextsCount());

        $id = $dictionary->id;

        $response = $this->actingAs($user)
            ->delete(route(Routes::DICTIONARIES_DESTROY, [$id]));

        $this->assertDatabaseCount('dictionaries', 0)
            ->assertDatabaseCount('words', 0)
            ->assertDatabaseCount('contexts', 0);

        $response->assertRedirect(route(Routes::DICTIONARIES_INDEX));
    }

    public function testDestroySomeoneElse()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $dictionaryGenerator = App::make(DictionaryGenerator::class);
        $dictionary = $dictionaryGenerator->generateDictionaryWithRelations($user1);

        $this->assertDatabaseCount('dictionaries', $dictionaryGenerator->getTotalDictionariesCount())
            ->assertDatabaseCount('words', $dictionaryGenerator->getTotalWordsCount())
            ->assertDatabaseCount('contexts', $dictionaryGenerator->getTotalContextsCount());

        $id = $dictionary->id;

        $response = $this->actingAs($user2)
            ->delete(route(Routes::DICTIONARIES_DESTROY, [$id]));

        $this->assertDatabaseCount('dictionaries', $dictionaryGenerator->getTotalDictionariesCount())
            ->assertDatabaseCount('words', $dictionaryGenerator->getTotalWordsCount())
            ->assertDatabaseCount('contexts', $dictionaryGenerator->getTotalContextsCount());

        $response->assertStatus(403);
    }

    public function testDestroyNotAuthorized()
    {
        $user = User::factory()->create();

        $dictionaryGenerator = App::make(DictionaryGenerator::class);
        $dictionary = $dictionaryGenerator->generateDictionaryWithRelations($user);

        $this->assertDatabaseCount('dictionaries', $dictionaryGenerator->getTotalDictionariesCount())
            ->assertDatabaseCount('words', $dictionaryGenerator->getTotalWordsCount())
            ->assertDatabaseCount('contexts', $dictionaryGenerator->getTotalContextsCount());

        $id = $dictionary->id;

        $response = $this->delete(route(Routes::DICTIONARIES_DESTROY, [$id]));

        $this->assertDatabaseCount('dictionaries', $dictionaryGenerator->getTotalDictionariesCount())
            ->assertDatabaseCount('words', $dictionaryGenerator->getTotalWordsCount())
            ->assertDatabaseCount('contexts', $dictionaryGenerator->getTotalContextsCount());

        $response->assertRedirect(route('login'));
    }
}
