<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentImagesTable extends Migration {

	public function up()
	{
		Schema::create('comment_images', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->unsignedBigInteger('comment_id');
			$table->string('path_img');
		});
	}

	public function down()
	{
		Schema::drop('comments_images');
	}
}
