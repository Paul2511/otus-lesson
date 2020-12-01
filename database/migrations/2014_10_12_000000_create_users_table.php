<?php

use App\Models\User;
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
            $table->string('name', 50)
                ->nullable();
            $table->string('email', 50)
                ->unique();
            $table->string('phone', 30)
                ->unique()
                ->nullable();
            $table->timestamp('email_verified_at')
                ->nullable();
            $table->string('password', 255);
            $table->smallInteger('status')
                ->default(User::STATUS_INACTIVE);
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
