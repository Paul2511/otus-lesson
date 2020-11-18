<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    /**
     * Пользватели
     *
     * регистрация/авторизация по почте
     * но предполагается создание записей-пустышек для роли anonymous, когда приходит вопрос из "Контактов"
     * (например, с указанным номера телефона и без почты)
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id')->unsigned()->index('fk_users_roles_idx');
            $table->unsignedBigInteger('personal_id')->nullable()->index('fk_users_personals_idx');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('users');
    }
}
