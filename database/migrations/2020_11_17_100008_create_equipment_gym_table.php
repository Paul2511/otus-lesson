<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentGymTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('equipment_gym', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gym_id')->unsigned()->nullable()->index('fk_equipment_gym_gym_id_idx');
            $table->unsignedBigInteger('equipment_id')->nullable()->index('fk_equipment_gym_equipment_id_idx');
            $table->integer('count_equipment')->nullable();
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
        Schema::drop('equipment_gym');
    }
}
