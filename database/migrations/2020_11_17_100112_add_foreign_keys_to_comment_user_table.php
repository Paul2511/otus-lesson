<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCommentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('comment_user', function (Blueprint $table) {
            $table->foreign('comment_id', 'fk_comment_user_comment_id')->references('id')->on('comments')->onUpdate('CASCADE');
            $table->foreign('user_id', 'fk_comment_user_user_id')->references('id')->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('comment_user', function (Blueprint $table) {
            $table->dropForeign('fk_comment_user_comment_id');
            $table->dropForeign('fk_comment_user_user_id');
        });
    }
}
