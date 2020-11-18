<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToContentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('content_user', function (Blueprint $table) {
            $table->foreign('content_id', 'fk_content_user_content_id')->references('id')->on('contents')->onUpdate('CASCADE');
            $table->foreign('user_id', 'fk_content_user_user_id')->references('id')->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('content_user', function (Blueprint $table) {
            $table->dropForeign('fk_content_user_content_id');
            $table->dropForeign('fk_content_user_user_id');
        });
    }
}
