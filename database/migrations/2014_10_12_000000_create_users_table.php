<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedBigInteger('inn')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('position')->nullable();
            $table->unsignedBigInteger('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedInteger('otp');
            $table->boolean('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
