<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration {

	public function up()
	{
		Schema::create('tags', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('title')->unique();
			$table->string('color');
		});
	}

	public function down()
	{
		Schema::drop('tags');
	}
}
