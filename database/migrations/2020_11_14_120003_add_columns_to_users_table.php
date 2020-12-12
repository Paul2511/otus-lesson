<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //$table->smallInteger('role')->unsigned()->default(User::ROLE_CLIENT);
            $table->string('role', 10)->default(User::ROLE_CLIENT);
            $table->smallInteger('status')->unsigned()->default(User::STATUS_ACTIVE);
            $table->string('phone', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role', 'status', 'phone');
        });
    }
}
