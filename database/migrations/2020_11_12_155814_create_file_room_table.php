<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_room', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('file_id')->references('id')->on('files')->onDelete('cascade');
            $table->foreignUuid('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreignUuid('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreignUuid('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('deleted')->unsigned(); // флаг удаления владельцем
            $table->tinyInteger('ban')->unsigned(); // флаг удаления администратором
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_room');
    }
}
