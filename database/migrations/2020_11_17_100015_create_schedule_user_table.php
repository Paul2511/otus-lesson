<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleUserTable extends Migration
{
    /**
     * Расписание гостя
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('schedule_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('fk_schedule_user_user_id_idx');
            $table->unsignedBigInteger('schedule_id')->index('fk_schedule_user_schedule_id_idx');
            $table->integer('status')->default(10);//Запись на занятие ожидает подтверджения
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
        Schema::drop('schedule_user');
    }
}
