<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreignUuid('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('deleted')->unsigned(); // флаг удаления владельцем
            $table->tinyInteger('ban')->unsigned(); // флаг удаления администратором
            $table->string('text_view');
            $table->string('text_raw');
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
        Schema::dropIfExists('messages');
    }
}
