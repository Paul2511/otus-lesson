<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration {

	public function up()
	{
		Schema::create('tasks', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->unsignedBigInteger('column_id')->index();
			$table->unsignedBigInteger('user_id')->index();
			$table->string('title');
			$table->string('description');
			$table->string('watcher')->nullable();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('tasks');
	}
}
