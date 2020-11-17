<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFileUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('file_user', function (Blueprint $table) {
            $table->foreign('file_id', 'fk_file_user_file_id')->references('id')->on('files')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('user_id', 'fk_file_user_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('file_user', function (Blueprint $table) {
            $table->dropForeign('fk_file_user_file_id');
            $table->dropForeign('fk_file_user_user_id');
        });
    }
}
