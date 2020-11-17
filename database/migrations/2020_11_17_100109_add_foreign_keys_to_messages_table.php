<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('chat_id', 'fk_messages_chat_id')->references('id')->on('chats')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('author_id', 'fk_messages_author_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('fk_messages_chat_id');
            $table->dropForeign('fk_messages_author_id');
        });
    }
}
