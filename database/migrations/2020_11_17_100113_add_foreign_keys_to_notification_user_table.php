<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('notification_user', function (Blueprint $table) {
            $table->foreign('notification_id', 'fk_notification_user_notification_id')->references('id')->on('notifications')->onUpdate('CASCADE');
            $table->foreign('user_id', 'fk_notification_user_user_id')->references('id')->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('notification_user', function (Blueprint $table) {
            $table->dropForeign('fk_notification_user_notification_id');
            $table->dropForeign('fk_notification_user_user_id');
        });
    }
}
