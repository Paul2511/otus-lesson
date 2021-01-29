<?php


namespace Http\Controllers\Auth;


use App\Services\Auth\Register\RegisterService;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    private function getRegisterService(): RegisterService
    {
        return app(RegisterService::class);
    }

    public function testCreate()
    {
        $userData = UserGenerator::generateDataRegister();

        $user = $this->getRegisterService()->register($userData);
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);

        $this->assertNotEmpty($user);

    }

}
