<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pet_types', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->renameColumn('title', 'title_ru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pet_types', function (Blueprint $table) {
            $table->renameColumn('title_ru', 'title');
            $table->dropColumn('title_en');
        });
    }
}
