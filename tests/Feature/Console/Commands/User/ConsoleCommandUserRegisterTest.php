<?php


namespace Tests\Feature\Console\Commands\User;

use App\Models\User;
use App\Notifications\User\UserWelcome;
use Tests\TestCase;
use Symfony\Component\Console\Exception\RuntimeException;
use Illuminate\Support\Facades\Notification;
class ConsoleCommandUserRegisterTest extends TestCase
{

    private static $command = 'user:register';

    /**
     * Запуск без аргумента
     * @group console
     * @group register
     */
    public function testEmptyArgumentWrongException()
    {
        try {
            $this->artisan(self::$command)->assertExitCode(1);
        } catch (RuntimeException $e) {
            $this->assertEquals('Not enough arguments (missing: "role").', $e->getMessage());
        }
    }

    /**
     * Неверный аргумент role
     * @group console
     * @group register
     */
    public function testWrongArgumentRole1()
    {
        $this->artisan(self::$command, ['role'=>'editor'])
            ->expectsOutput("The role editor is not supported!")
            ->assertExitCode(1);
    }

    /**
     * Попытка без указания email
     * @group console
     * @group register
     */
    public function testEmptyEmail1()
    {
        $this->artisan(self::$command, ['role'=>'manager'])
            ->expectsQuestion('Email', '')
            ->expectsOutput(trans('validation.required', ['attribute'=>'Email']))
            ->assertExitCode(1);
    }

    /**
     * Неверный email
     * @group console
     * @group register
     */
    public function testWrongEmail1()
    {
        $this->artisan(self::$command, ['role'=>'manager'])
            ->expectsQuestion('Email', 'wrong-email')
            ->expectsOutput(trans('validation.email'))
            ->assertExitCode(1);
    }

    /**
     * Успешное выполнение с указанием параметров
     * @group console
     * @group register
     */
    public function testSpecifyParamsSuccess0()
    {
        $this->artisan(self::$command, ['role'=>'admin', '--email'=>'test@mail.com', '--no-send'=>true])
            ->assertExitCode(0);

        $this->assertDatabaseHas('users', [
            'email' => 'test@mail.com',
        ]);
        /** @var User $user */
        $user = User::where(['email'=>'test@mail.com'])->first();

        $this->assertDatabaseHas('user_details', [
            'user_id' => $user->id
        ]);
    }

    /**
     * Успешное выполнение с вводом параметров и отправкой письма
     * @group console
     * @group register
     */
    public function testEnterParamsSuccess0()
    {
        Notification::fake();

        $this->artisan(self::$command, ['role'=>'admin', '--password'=>true])
            ->expectsQuestion('Email', 'test@mail.com')
            ->expectsQuestion('Password (skip to generate random)', '12345')
            ->assertExitCode(0);

        /** @var User $user */
        $user = User::where(['email'=>'test@mail.com'])->first();

        Notification::assertSentTo($user, UserWelcome::class);
    }
}