<?php


namespace Tests\Feature\Http\Controllers\Sources\AdvancedRecords;

use App\Services\Resources\Resources;
use App\Services\Routes\Providers\Auth\AuthRoutes;
use App\Services\Routes\Providers\Sources\SourcesRoutes;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class SourcesAdvancedRecordsControllerViewTest extends TestCase
{
    /**
     * @group source
     */
    public function testViewRedirectsNotAuthenticatedUsers()
    {
        $response = $this->get(
            route(SourcesRoutes::SOURCES_ADVANCED_RECORDS)
        );
        $response->assertStatus(302)->assertRedirect(AuthRoutes::AUTH_LOGIN);
    }

    /**
     * @group source
     */
    public function testViewReturns200ForAdmin()
    {
        $user=UsersGenerator::generateAdmin();
        $response = $this->actingAs($user)->get(
            route(SourcesRoutes::SOURCES_ADVANCED_RECORDS)
        );
        $response->assertStatus(200);
    }
    /**
     * @group source
     */
    public function testViewReturns403ForPlainUser()
    {
        $user=UsersGenerator::generatePlain();
        $response = $this->actingAs($user)->get(
            route(SourcesRoutes::SOURCES_ADVANCED_RECORDS)
        );
        $response->assertStatus(403);
    }

    /**
     * @group source
     */
    public function testViewReturns200ForPlainUser()
    {
        $user=UsersGenerator::generatePlain();
        $user= UsersGenerator::addResourceForUser($user, Resources::ADVANCED_RECORDS);
        $response = $this->actingAs($user)->get(
            route(SourcesRoutes::SOURCES_ADVANCED_RECORDS)
        );
        $response->assertStatus(200);
    }

}
