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
            $table->unsignedBigInteger('inn');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('middle_name',50)->nullable();
            $table->string('position',50)->nullable();
            $table->unsignedBigInteger('phone')->unique();
            $table->string('email')->unique();
            $table->string('password',200);
            $table->unsignedInteger('otp');
            $table->unsignedTinyInteger('status')->default(User::STATUS_ACTIVE);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('roles')
                ->onDelete('set null');
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
