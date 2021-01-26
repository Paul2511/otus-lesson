<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();
        });

        Schema::table('user_roles', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('user_roles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('user_roles', function (Blueprint $table) {
            $table->dropForeign('user_roles_role_id_foreign');
            $table->dropForeign('user_roles_user_id_foreign');
        });
        Schema::dropIfExists('user_roles');
    }
}
