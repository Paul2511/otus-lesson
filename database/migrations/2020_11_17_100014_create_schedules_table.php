<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_training')->nullable();
            $table->integer('time_id')->unsigned()->nullable()->index('fk_schedules_time_id_idx');
            $table->unsignedBigInteger('user_id')->nullable()->index('fk_schedules_user_id_idx');
            $table->integer('section_id')->unsigned()->nullable()->index('fk_schedules_section_id_idx');
            $table->integer('gym_id')->unsigned()->nullable()->index('fk_schedules_gim_id_idx');
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
        Schema::drop('schedules');
    }
}
