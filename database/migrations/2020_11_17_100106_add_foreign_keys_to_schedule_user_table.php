<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToScheduleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('schedule_user', function (Blueprint $table) {
            $table->foreign('schedule_id', 'fk_schedule_user_schedule_id')->references('id')->on('schedules')->onUpdate('CASCADE');
            $table->foreign('user_id', 'fk_schedule_user_user_id')->references('id')->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('schedule_user', function (Blueprint $table) {
            $table->dropForeign('fk_schedule_user_schedule_id');
            $table->dropForeign('fk_schedule_user_user_id');
        });
    }
}
