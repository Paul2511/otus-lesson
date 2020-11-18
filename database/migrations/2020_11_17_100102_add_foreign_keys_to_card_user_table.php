<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCardUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('card_user', function (Blueprint $table) {
            $table->foreign('card_id', 'fk_card_user_card_id')->references('id')->on('cards')->onUpdate('CASCADE');
            $table->foreign('user_id', 'fk_card_user_user_id')->references('id')->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('card_user', function (Blueprint $table) {
            $table->dropForeign('fk_card_user_card_id');
            $table->dropForeign('fk_card_user_user_id');
        });
    }
}
