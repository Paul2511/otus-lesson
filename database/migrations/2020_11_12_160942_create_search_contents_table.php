<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_contents', function (Blueprint $table) {
            $table->string('title')->index(); // заголовок
            $table->string('content'); // поисковый контент
            $table->string('entity_type'); // сущность, например USER / POST
            $table->string('entity_id'); // идентификатор сущности
            $table->string('path'); // ссылка (URI)
            $table->integer('weight')->unsigned()->default(0); // вес для сортировки поисковой выдачи
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_contents');
    }
}
