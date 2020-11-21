<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{

    /**
     * Чаты обращений в тех поддержку - создается на гостя клуба
     * После отправки обращения гостем - на его id создется уникальный чат,
     * к которому будут привязаны сообщения - вопросы гостя и ответы тех поддерки
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('fk_chats_guest_id_idx');//гость клуба
            $table->integer('status')->default(10)->index('fk_chats_status_idx');
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
        Schema::drop('chats');
    }
}
