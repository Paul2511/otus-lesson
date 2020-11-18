<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreign('gym_id', 'fk_schedules_gym_id')->references('id')->on('gyms')->onUpdate('CASCADE');
            $table->foreign('section_id', 'fk_schedules_section_id')->references('id')->on('sections')->onUpdate('CASCADE');
            $table->foreign('time_id', 'fk_schedules_time_id')->references('id')->on('times')->onUpdate('CASCADE');
            $table->foreign('trainer_id', 'fk_schedules_user_id')->references('id')->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign('fk_schedules_gym_id');
            $table->dropForeign('fk_schedules_section_id');
            $table->dropForeign('fk_schedules_time_id');
            $table->dropForeign('fk_schedules_user_id');
        });
    }
}
