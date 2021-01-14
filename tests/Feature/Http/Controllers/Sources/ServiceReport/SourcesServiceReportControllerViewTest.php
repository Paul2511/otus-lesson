<?php


namespace Tests\Feature\Http\Controllers\Sources\ServiceReport;

use App\Services\Resources\Resources;
use App\Services\Routes\Providers\Auth\AuthRoutes;
use App\Services\Routes\Providers\Sources\SourcesRoutes;
use Illuminate\Support\Facades\Artisan;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class SourcesServiceReportControllerViewTest extends TestCase
{
    /**
     * @group source
     */
    public function testViewRedirectsNotAuthenticatedUsers()
    {
        $response = $this->get(
            route(SourcesRoutes::SOURCES_REPORT_SERVICE)
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
            route(SourcesRoutes::SOURCES_REPORT_SERVICE)
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
            route(SourcesRoutes::SOURCES_REPORT_SERVICE)
        );
        $response->assertStatus(403);
    }

    /**
     * @group source
     */
    public function testViewReturns200ForPlainUser()
    {
        $user=UsersGenerator::generatePlain();
        $user= UsersGenerator::addResourceForUser($user, Resources::REPORT_SERVICE);

        $response = $this->actingAs($user)->get(
            route(SourcesRoutes::SOURCES_REPORT_SERVICE)
        );

        $response->assertStatus(200);
    }

}
