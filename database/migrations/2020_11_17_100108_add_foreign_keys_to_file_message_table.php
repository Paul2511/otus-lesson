<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFileMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('file_message', function (Blueprint $table) {
            $table->foreign('file_id', 'fk_file_message_file_id')->references('id')->on('files')->onUpdate('CASCADE');
            $table->foreign('message_id', 'fk_file_message_message_id')->references('id')->on('messages')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('file_message', function (Blueprint $table) {
            $table->dropForeign('fk_file_message_file_id');
            $table->dropForeign('fk_file_message_message_id');
        });
    }
}
