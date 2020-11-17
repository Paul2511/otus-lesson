<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->smallInteger('status')->unsigned()->default(Role::STATUS_ACTIVE); // состояние роли, отключение / включение / удаление
            $table->smallInteger('level')->unsigned()->default(Role::LEVEL_USER); // уровень доступа, определяет роль
            $table->string('description'); // описание роли
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
        Schema::dropIfExists('roles');
    }
}
