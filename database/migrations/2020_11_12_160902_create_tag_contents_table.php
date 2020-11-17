<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_contents', function (Blueprint $table) {
            $table->foreignUuid('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->smallInteger('entity_type'); // сущность, например USER / POST
            $table->string('entity_id')->index(); // идентификатор сущности
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_contents');
    }
}
