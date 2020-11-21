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
            $table->integer('role')->default(10)->index('fk_users_roles_idx');//min rank = 10 (anonymous)
            $table->string('email')->unique()->nullable()->index('fk_users_email_idx');
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('telephone')->nullable();
            $table->date('birthday')->nullable();
            $table->unsignedBigInteger('file_id')->default(1)->index('fk_users_files_idx');//аватарка
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
