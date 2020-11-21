<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Формирование/редактирование расписания клуба на конкретные даты
     * (для упрощения логики 2-х недельного расписания по четности, отмен и замен, избежания конфликтов)
     * Ограничения на уникальность добавляемых записей будут определены в коде
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->integer('time_id')->unsigned()->index('fk_schedules_time_id_idx');//время всегда указываем
            $table->unsignedBigInteger('user_id')->nullable()->index('fk_schedules_user_id_idx');//тренер
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
