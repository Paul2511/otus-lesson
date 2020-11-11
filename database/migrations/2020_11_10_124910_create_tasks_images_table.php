<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksImagesTable extends Migration {

	public function up()
	{
		Schema::create('tasks_images', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->unsignedBigInteger('task_id');
			$table->string('path_img');
		});
	}

	public function down()
	{
		Schema::drop('tasks_images');
	}
}
