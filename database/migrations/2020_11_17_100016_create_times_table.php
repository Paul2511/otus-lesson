<?php

use App\Models\Time;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Временные интервалы занятий
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->time('start');
            $table->time('end');
            $table->integer('status')->default(Time::STATUS_ACTIVE);
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
        Schema::drop('times');
    }
}
