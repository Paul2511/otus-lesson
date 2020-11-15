<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('company_uuid');
            $table->string('specialist_uuid')->unique();
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('middle_name',50)->nullable();
            $table->datetime('dob');
            $table->string('position',200)->nullable();
            $table->timestamps();
            $table->foreign('company_uuid')
                    ->references('company_uuid')
                    ->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialists');
    }
}
