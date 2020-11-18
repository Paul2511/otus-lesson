<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEquipmentGymTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('equipment_gym', function (Blueprint $table) {
            $table->foreign('equipment_id', 'fk_equipment_gym_equipment_id')->references('id')->on('equipments')->onUpdate('CASCADE');
            $table->foreign('gym_id', 'fk_equipment_gym_gym_id')->references('id')->on('gyms')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('equipment_gym', function (Blueprint $table) {
            $table->dropForeign('fk_equipment_gym_equipment_id');
            $table->dropForeign('fk_equipment_gym_gym_id');
        });
    }
}
