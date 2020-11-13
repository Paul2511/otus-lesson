<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleHasPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->index();
            $table->unsignedBigInteger('permissions_id')->index();
            $table->timestamps();
        });

        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('role_has_permissions_role_id_foreign');
            $table->dropForeign('role_has_permissions_permission_id_foreign');
        });

        Schema::dropIfExists('role_has_permissions');
    }
}
