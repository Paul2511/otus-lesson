<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymsTable extends Migration
{
    /**
     * Залы
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('number');//все залы должны иметь номер
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
        Schema::drop('gyms');
    }
}