<?php

use App\States\User\Role\ClientUserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Services\Localise\Locale;
use App\States\User\Status\ActiveUserStatus;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('role', 10)->default(ClientUserRole::$name);
            $table->string('status', 10)->default(ActiveUserStatus::$name);
            $table->string('phone', 15)->nullable();
            $table->string('locale', 4)->default(Locale::LOCALE_RU);
            $table->json('avatar')->nullable();
            $table->string('timezone')->default('Europe/Moscow');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
