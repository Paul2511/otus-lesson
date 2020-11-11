<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsTable extends Migration {

	public function up()
	{
		Schema::create('columns', function(Blueprint $table) {
			$table->id();
            $table->string('title');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('columns');
	}
}
