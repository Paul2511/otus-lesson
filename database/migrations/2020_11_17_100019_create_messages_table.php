<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Сообщения
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('chat_id')->index('fk_messages_chat_id_idx');
            $table->unsignedBigInteger('user_id')->index('fk_messages_author_id_idx');//автор сообщения
            $table->integer('status')->default(10)->index('fk_messages_status_idx');//Ожидает ответа
            $table->text('title')->nullable();
            $table->text('text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('messages');
    }
}
