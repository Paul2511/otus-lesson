<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique()->index();
            $table->integer('priority')->unsigned()->default(1000); // индекс сортировки, для ручного урпавления позицией поста в выводе
            $table->string('name_view');
            $table->string('name_raw');
            $table->string('text_view');
            $table->string('text_raw');
            $table->string('source_link');
            $table->string('source_label');
            $table->smallInteger('status')->unsigned(); // состояние поста, отключение / включение / модерация / удаление владельцем / удаление администратором
            $table->foreignUuid('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('redactor_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('counter_like')->unsigned(); // счетчик лайков, формируется из сырых данных таблицы reactions
            $table->integer('counter_dislike')->unsigned(); // счетчик дизлайков, формируется из сырых данных таблицы reactions
            $table->integer('counter_favorite')->unsigned(); // счетчик избранного, формируется из сырых данных таблицы reactions
            $table->integer('counter_views')->unsigned(); // счетчик просмотров, формируется из сырых данных таблицы reactions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
