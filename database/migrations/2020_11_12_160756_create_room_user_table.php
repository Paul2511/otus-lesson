<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_user', function (Blueprint $table) {
            $table->foreignUuid('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('message_first_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreignUuid('message_read_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreignUuid('message_last_id')->references('id')->on('messages')->onDelete('cascade');
            $table->tinyInteger('is_owner')->unsigned(); // флаг что пользователь является владельцем
            $table->tinyInteger('muted')->unsigned(); // флаг что пользователь заглушил уведомления чата
            $table->tinyInteger('ban')->unsigned(); // флаг блокировки пользователем
            $table->timestamp('joined_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_user');
    }
}
