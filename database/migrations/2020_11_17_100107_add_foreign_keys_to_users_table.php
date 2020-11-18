<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
    {
		Schema::table('users', function(Blueprint $table)
		{
			$table->foreign('personal_id', 'fk_users_personals')->references('id')->on('personals')->onUpdate('CASCADE');
			$table->foreign('role_id', 'fk_users_roles')->references('id')->on('roles')->onUpdate('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
    {
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('fk_users_personal');
			$table->dropForeign('fk_users_roles');
		});
	}

}
